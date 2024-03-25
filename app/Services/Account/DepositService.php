<?php

namespace App\Services\Account;

use App\Enums\PaymentStatus;
use App\Enums\Services;
use App\Enums\TransactionType;
use App\Models\Services\Service;
use App\Models\Transactions\Transaction;
use App\Services\Transactions\TransactionService;

class DepositService {

    private $user;
    private $shortcode = Services::DEPOSIT;
    public Service $service;

    public function __construct($user = null) {
        $this->user = $user ?? authenticated();
        $this->service = Service::whereShortcode($this->shortcode)->first();
    }

    function paymentMethods($country_code = null){
        return $this->service->paymentMethods()
                ->isActive('payment_methods.status')
                ->where('isOnline', true)
                ->whereHas('countries',
                    fn($query) => $query->isActive('countries.status')->where('iso_code', $country_code ?? $this->user->country_code)
                )
                ->get();
    }

    function initiate($data){
        $transactionService = new TransactionService;
        $data['type'] = Services::DEPOSIT->value;
        $data['narration'] = "Funds Deposit";
        [$status, $message, $transaction] = $transactionService->create($data, TransactionType::CREDIT, $this->user);
        if(!$status) return status($status, $message);

        return $transactionService->init($transaction);
    }

    function verify($transaction, $user = null){
        $user = $user ?? authenticated();
        [$status, $message, $transaction] = (new TransactionService)->verify($transaction);

        if($status) {
            if($transaction->status == PaymentStatus::SUCCESS) {
                [$status, $message] = (new WalletService)->fulfill($transaction->user->wallet, $transaction);
                if(!$status) throw new \Exception($message);
            }
        }

        return status($status, $message);
    }

    function cancel($transaction){
        return (new TransactionService)->cancel($transaction);
    }

}
