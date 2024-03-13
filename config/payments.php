<?php
use App\Services\PaymentMethods\PaystackService;
use App\Services\PaymentMethods\WalletService;

return [

    'services' => [
        ['name' => 'Deposit', 'shortcode' => 'deposit'],
        ['name' => 'Withdrawal', 'shortcode' => 'withdrawal'],
        ['name' => 'Airtime', 'shortcode' => 'airtime'],
        'international_airtime' => [

        ],

        'cug_data' => [

        ],
    ],

    'methods' => [
        'paystack' => PaystackService::class,
        'wallet' => WalletService::class,
    ]

];
