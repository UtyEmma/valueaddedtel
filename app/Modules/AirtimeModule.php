<?php

namespace App\Modules;

use App\Enums\PaymentStatus;
use App\Enums\Status;
use App\Models\Transactions\Transaction;
use App\Models\User;
use App\Services\Transactions\PurchaseService;
use App\Services\Transactions\TransactionService;

class AirtimeModule {

    function create($data, User $user = null){
        $user = $user ?? authenticated();
        [$status, $message, $transaction] = (new TransactionService)->create($data, $user);
        if(!$status) return status($status, $message);

        return status($status, $message, $transaction);
    }

    function initiate(Transaction $transaction) {
        [$status, $message, $transaction] = $transaction->init();

        if(!$status) return status($status, $message);

        if($transaction->status == PaymentStatus::PENDING) return status(true, 'PENDING', $transaction->data);

        if($transaction->status == PaymentStatus::SUCCESS) {
            // $purchase = $this->purchase($data, $user, $transaction);
            // return status(true, 'SUCCESS', $purchase);
        }
    }

    function purchase($data, $user, $transaction){
        $purchase = new PurchaseService;

    }

    function verify(){

    }

    function query(){

    }

}
