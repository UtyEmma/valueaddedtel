<?php

namespace App\Enums;

enum PaymentMethods:string {

    case WALLET = 'wallet';
    case PAYSTACK = 'paystack';
    case MANUAL_TRANSFER = 'manual';
    case BANK_TRANSFER = 'bank_transfer';

}
