<?php

namespace App\Modules;

use App\Enums\PaymentStatus;
use App\Enums\Services;
use App\Enums\Status;
use App\Models\Services\Service;
use App\Models\Transactions\Transaction;
use App\Models\User;
use App\Services\Transactions\PurchaseService;
use App\Services\Transactions\TransactionService;

class AirtimeModule {

    function initiate($data) {

    }

    function purchase($data, $user){
        $purchaseService = new PurchaseService($user);
        [$status, $message] = $purchaseService->create(Services::AIRTIME, $data['network'], $data);
        if(!$status) return status($status, $message);
        [$status, $message, $purchase] = $purchaseService->handle();
        return status($status, $message, $purchase);
    }

    function verify(){

    }

    function query(){

    }

}
