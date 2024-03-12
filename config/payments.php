<?php
use App\Services\PaymentMethods\PaystackService;
use App\Services\PaymentMethods\WalletService;

return [

    'methods' => [
        'paystack' => PaystackService::class,
        'wallet' => WalletService::class,
    ]

];
