<?php

namespace App\Enums;

use App\Services\PaymentMethods\PaystackService;
use App\Services\PaymentMethods\WalletService;

enum PaymentMethods:string {

    case WALLET = 'wallet';
    case PAYSTACK = 'paystack';
    case MANUAL_TRANSFER = 'manual';
    case MONNIFY = 'monnify';
    case BANK_TRANSFER = 'bank_transfer';

    static function instance($key){
        return match ($key) {
            self::PAYSTACK => new PaystackService
        };
    }

}
