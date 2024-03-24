<?php

namespace App\Services\Transactions;

use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Enums\ServiceProviders;
use App\Enums\Services;
use App\Enums\Status;
use App\Library\Token;
use App\Models\Services\Service;
use App\Models\Services\ServiceProduct;
use App\Models\Transactions\Purchase;
use App\Models\User;
use App\Services\Account\WalletService;

class PurchaseService {

    protected User $user;
    protected Service $service;
    protected Purchase $purchase;

    function __construct(User $user = null, ) {
        $this->user = $user ?? authenticated();
    }

    function service($key){
        $service = Service::whereShortcode($key)
                            ->whereHas('serviceCountries', function($query) {
                                $query->where([
                                    'country_code' => $this->user->country_code,
                                    'status' => Status::ACTIVE
                                ]);
                            })->isActive()->first();

        if(!$service) return status(false, 'Airtime Purchase is currently unavailable in your country! Please check back later.');
        $this->service = $service;
        return status(true, '', $service);
    }

    function getProduct($product_code){
        if($product = $this->service->products()->whereShortcode($product_code)->first()) return status(true, '', $product);
        return status(false, 'The selected product does not exist. Please try again.');
    }

    function provider($purchase){
        $provider = ServiceProviders::instance($purchase);
        if($provider) return status(true, '', $provider);
        return status(false, 'The provider is not currently active at the moment. Please contact our support center!');
    }

    function validate($data){
        $data = collect($data);

        if(!isset($data['service_code'])) {
            return status(false, 'No Service Provider is provided for this purchase.');
        }

        if(!$service = Service::where('shortcode', $data['service_code'])->first()){
            return status(false, 'The selected service provider is invalid.');
        }

        if($service->status == Status::INACTIVE){
            return status(false, 'The selected service provider is invalid.');
        }
    }

    function create(Services $service_code, $product_code, $data, $purchaseStatus = PaymentStatus::PENDING) {
        $user = $this->user;

        [$status, $message] = $this->service($service_code);
        if(!$status) return status($status, $message);

        [$status, $message, $product] = $this->getProduct($product_code);
        if(!$status) return status($status, $message);

        if(isset($data['product_item'])) {
            if(!$item = $product->items()->whereShortcode($data['product_item'])->first()) {
                return status(false, 'The selected product item does not exist');
            }

            if($item->status !== Status::ACTIVE) {
                return status(false, 'The selected product item is not available at the moment');
            }
        }

        $reference = (new Token)->numeric(Purchase::class, 'reference');

        $purchase = new Purchase([
            'amount' => $data['amount'],
            'meta' => $data,
            'reference' => $reference,
            'narration' => $this->service->name,
            'country_code' => $user->country_code,
            'currency_code' => $user->currency_code,
            'provider_code' => $product->provider->shortcode,
            'service_code' => $this->service->shortcode,
            'product_code' => $product->shortcode,
            'product_item_code' => $data['product_item'] ?? null,
            'mode' => $product->provider->mode,
            'status' => $purchaseStatus
        ]);

        $this->purchase = $user->purchases()->save($purchase);

        return status(true, '', $this->purchase);
    }

    function handle() {
        [$status, $message, $provider] = $this->provider($this->purchase);

        if(!$status) return status($status, $message);
        [$status, $message, $data] = $provider->handle();
        if(!$status) {
            $this->purchase->status = PaymentStatus::CANCELLED;
            $this->purchase->remark = $message;
            $this->purchase->save();
            return status(false, $message);
        };

        return $this->resolve($status, $message, $data);
    }

    function resolve($status, $message, $data) {
        if($status == PaymentStatus::FAILED) {
            [$status, $message, $data] = $this->verify($this->purchase);
            if(!$status) return status(false, $message);
        }

        $this->purchase->status = $status;
        $this->purchase->meta = $data;
        $this->purchase->save();

        if(in_array($this->purchase->status, [PaymentStatus::SUCCESS, PaymentStatus::PENDING])) {
            $this->charge(); //Charge the user's wallet if the user's wallet is pending
        }

        if(PaymentStatus::SUCCESS){
            $this->reward();
        }

        return status(true, PaymentStatus::message($this->purchase->status), $this->purchase);
    }

    function charge(){
        $transactionService = new TransactionService;
        (new WalletService)->charge($this->user->wallet, $this->purchase->amount);

        [$status, $message, $transaction] = $transactionService->create([
            'type' => Services::DEPOSIT->value,
            'narration' => 'Payment for '.$this->service->name,
            'amount' => $this->purchase->amount,
            'payment_method' => PaymentMethods::WALLET
        ], $this->user, PaymentStatus::SUCCESS);

        if(!$status) return status($status, $message);

        $transaction->transactable()->associate($this->purchase);
        $transaction->save();
    }

    function reward() {
        if(!$this->user->package->cashback) return;

        if($cashbackAmount = $this->purchase->product->cashbackAmount) {
            (new WalletService)->fund($this->user->wallet, $cashbackAmount);

            (new TransactionService)->create([
                'type' => Services::DEPOSIT->value,
                'narration' => 'Cashback for '.$this->purchase->service->name,
                'amount' => $cashbackAmount,
                'payment_method' => PaymentMethods::WALLET
            ], $this->purchase->user, PaymentStatus::SUCCESS);
        }
    }

    function verify(Purchase $purchase){
        [$status, $message, $provider] = $this->provider($purchase);
        if(!$status) return status($status, $message);

        return $provider->verify();
    }

}
