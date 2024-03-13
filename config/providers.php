<?php

use App\Services\Account\WalletService;
use App\Services\PaymentMethods\PaystackService;
use App\Services\Providers\TopUpAccessService;
use App\Services\Providers\VtPassService;

return [

    'payments' => [
        'paystack' => PaystackService::class,
        'wallet' => WalletService::class,
    ],

    'services' => [
        'vtpass' => VtPassService::class,
        'topupaccess' => TopUpAccessService::class
    ],

];
