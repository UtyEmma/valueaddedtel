<?php

use App\Enums\PaymentMethods;
use App\Services\Account\WalletService;
use App\Services\PaymentMethods\MonnifyService;
use App\Services\PaymentMethods\PaystackService;
use App\Services\Providers\TopUpAccessService;
use App\Services\Providers\VtPassService;

return [

    'payments' => [
        PaymentMethods::PAYSTACK->value => PaystackService::class,
        PaymentMethods::WALLET->value => WalletService::class,
        PaymentMethods::MONNIFY->value => MonnifyService::class
    ],

    'services' => [
        'vtpass' => VtPassService::class,
        'topupaccess' => TopUpAccessService::class
    ],

];
