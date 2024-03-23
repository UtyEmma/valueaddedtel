<?php

namespace App\Services\PaymentMethods;

use App\Contracts\Payment;
use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Models\Transactions\PaymentMethod;
use App\Models\Transactions\Transaction;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PaystackService implements Payment {

    private $api;
    private $paymentMethod;
    private $keys;

    function __construct(){
        $this->paymentMethod = PaymentMethod::whereShortcode(PaymentMethods::PAYSTACK)->first();
        $this->setKeys();
        $this->api = Http::baseUrl($this->keys['URL'])
                        ->withToken($this->keys['SECRET_KEY'])
                        ->acceptJson()
                        ->asJson();
    }

    function setKeys(){
        $meta = $this->paymentMethod->meta;

        if($this->paymentMethod->is_live_mode) {
            $this->keys = [
                'URL' => $meta['PAYSTACK_URL'],
                'PUBLIC_KEY' => $meta['PAYSTACK_TEST_PUBLIC_KEY'],
                'SECRET_KEY' => $meta['PAYSTACK_LIVE_SECRET_KEY']
            ];
        }

        if($this->paymentMethod->is_test_mode) {
            $this->keys = [
                'URL' => $meta['PAYSTACK_URL'],
                'PUBLIC_KEY' => $meta['PAYSTACK_LIVE_PUBLIC_KEY'],
                'SECRET_KEY' => $meta['PAYSTACK_TEST_SECRET_KEY']
            ];
        }

        return $this->keys;
    }

    function resolve(Response $req){

        if($req->ok()) {
            $data = $req->json();
            if(!$data['status'] ?? null) return status(false, "Your transaction could not be verified at the moment. Please contact our support.");

            return status(true, '', $data['data']);
        }

        return status(false, 'Your request could not be completed');
    }

    function pay(Transaction $transaction){
        $data = [
            'email' => $transaction->payer->email,
            'amount' => $transaction->amount * 100,
            'reference' => $transaction->reference,
            'metadata' => [
                'transaction' => $transaction->id
            ],
            'callback_url' => '',
            'currency' => $transaction->currency
        ];

        return $this->resolve($this->api->post('transaction/initialize', $data));
    }

    function initiate(Transaction $transaction){
        $data = [
            'key' => $this->keys['PUBLIC_KEY'],
            'email' => $transaction->user->email,
            'amount' => $transaction->amount * 100,
            'ref' => $transaction->reference,
            'currency' => $transaction->currency_code
        ];

        return status(true, '', $data);
    }

    function verify($reference){
        [$status, $message, $data] = $this->resolve($this->api->get("transaction/verify/$reference"));
        if(!$status) return status($status, $message);
        if($data['status'] == 'success') return status(true, PaymentStatus::SUCCESS);
        return status(true, PaymentStatus::FAILED);
    }

    function query($id){
        return $this->resolve($this->api->get("transaction/$id"));
    }

    function banks($country = null){
        return $this->resolve($this->api->get('bank', ['country' => $country]));
    }

    function countries(){
        return $this->resolve($this->api->get('country'));
    }

    function resolveAccountNumber($bank_code, $account_no){
        return $this->resolve($this->api->get("resolve?account_number=$account_no&bank_code=$bank_code"));
    }

}
