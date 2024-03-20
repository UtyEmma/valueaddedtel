<?php

use App\Enums\PaymentMethods;
use App\Services\PaymentMethods\MonnifyService;
use App\Services\PaymentMethods\PaystackService;
use App\Services\PaymentMethods\WalletService;
use App\Services\Providers\TopUpAccessService;
use App\Services\Providers\VtPassService;

return [

    'service_providers' => [
        'vtpass' => [
            'class' => VtPassService::class,
            'name' => 'VT Pass',
            'countries' => ['NG'],
            'shortcode' => 'vtpass',
            'mode' => 'test',
            'meta' => [
                'VTPASS_TEST_URL' => env('VTPASS_TEST_URL'),
                'VTPASS_LIVE_URL' => env('VTPASS_LIVE_URL'),
                'VTPASS_LIVE_KEY' => env('VTPASS_LIVE_KEY'),
                'VTPASS_PUBLIC_KEY' => env('VTPASS_PUBLIC_KEY'),
                'VTPASS_SECRET_KEY' => env('VTPASS_SECRET_KEY'),
                'VTPASS_TEST_KEY' => env('VTPASS_TEST_KEY'),
            ]
        ],

        'topupaccess' => [
            'class' => TopUpAccessService::class,
            'name' => 'Top Up Access',
            'countries' => ['NG'],
            'shortcode' => 'topupaccess',
            'mode' => 'test',
            'meta' => [
                'TOPUPACCESS_URL' => env('TOPUPACCESS_URL'),
                'TOPUPACCESS_KEY' => env('TOPUPACCESS_KEY'),
                'TOPUPACCESS_PIN' => env('TOPUPACCESS_PIN'),
                'TOPUPACCESS_NUMBER' => env('TOPUPACCESS_NUMBER'),
            ]
        ],

        'clubkonnect' => [
            'class' => VtPassService::class,
            'name' => 'Club Konnect',
            'countries' => ['NG'],
            'shortcode' => 'clubkonnect',
            'mode' => 'test',
            'meta' => [
                'CLUB_KONNECT_URL' => env('CLUB_KONNECT_URL'),
                'CLUB_KONNECT_KEY' => env('CLUB_KONNECT_KEY'),
                'CLUB_KONNECT_USER' => env('CLUB_KONNECT_USER'),
            ]
        ],
    ],

    'services' => [
        [
            'name' => 'Deposit',
            'shortcode' => 'deposit',
        ],
        [
            'name' => 'Withdrawal',
            'shortcode' => 'withdrawal',
        ],
        [
            'name' => 'Virtual Account',
            'shortcode' => 'virtual_account',
        ],
        [
            'name' => 'Airtime Topup',
            'shortcode' => 'airtime',
            'countries' => [
                'NG' => [
                    'provider_code' => 'vtpass',
                    'products' => [
                        [
                            'name' => 'MTN',
                            'shortcode' => 'mtn',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                        [
                            'name' => 'GLO',
                            'shortcode' => 'glo',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                        [
                            'name' => 'Airtel',
                            'shortcode' => 'airtel',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                        [
                            'name' => 'Etisalat',
                            'shortcode' => 'etisalat',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                    ]
                ]
            ]
        ],
        [
            'name' => 'International Airtime',
            'shortcode' => 'intl_airtime',
        ],
        [
            'name' => 'Recharge E-Pins',
            'shortcode' => 'recharge_pins',
            'countries' => [
                'NG' => [
                    'provider_code' => 'vtpass',
                    'products' => [
                        [
                            'name' => 'MTN',
                            'shortcode' => 'mtn',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                        [
                            'name' => 'GLO',
                            'shortcode' => 'glo',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                        [
                            'name' => 'Airtel',
                            'shortcode' => 'airtel',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                        [
                            'name' => 'Etisalat',
                            'shortcode' => 'etisalat',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                    ]
                ]
            ]
        ],
        [
            'name' => 'SME/CUG Data',
            'shortcode' => 'cug_data',
        ],
        [
            'name' => 'Internet Data',
            'shortcode' => 'internet_data',
            'countries' => [
                'NG' => [
                    'provider_code' => 'vtpass',
                    'products' => [
                        [
                            'name' => 'MTN',
                            'shortcode' => 'mtn',
                            'provider_code' => 'vtpass',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                            'items' => [
                                [
                                    'name' => '1/MTN SME 1GB (30DAYS VALIDITY)',
                                    'shortcode' => 1,
                                    'amount' => 300
                                ],
                                [
                                    'name' => '2/MTN 2GB SME (30DAYS VALIDITY)',
                                    'shortcode' => 2,
                                    'amount' => 600
                                ],
                                [
                                    'name' => '3/MTN SME 3GB (30DAYS VALIDITY)',
                                    'shortcode' => 3,
                                    'amount' => 900
                                ],
                            ]
                        ],
                        [
                            'name' => 'GLO',
                            'shortcode' => 'glo',
                            'provider_code' => 'vtpass',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                            'items' => [
                                [
                                    'name' => 'GLO 200MB (14 DAYS VALIDITY)',
                                    'shortcode' => 1,
                                    'amount' => 300
                                ]
                            ]
                        ],
                    ]
                ]
            ]
        ],
        [
            'name' => 'Smile Data',
            'shortcode' => 'smile',
        ],
        [
            'name' => 'Spectranet',
            'shortcode' => 'spectranet',
        ],
        [
            'name' => 'DSTV Subscription',
            'shortcode' => 'dstv',
        ],
        [
            'name' => 'GoTV Subscription',
            'shortcode' => 'gotv',
        ],
        [
            'name' => 'Startimes Subscription',
            'shortcode' => 'startimes',
        ],
        [
            'name' => 'Showmax Subscription',
            'shortcode' => 'showmax',
        ],
        [
            'name' => 'Electricity',
            'shortcode' => 'electricity',
            'countries' => [
                'NG' => [
                    'provider_code' => 'vtpass',
                    'products' => [
                        [
                            'name' => 'EEDC',
                            'shortcode' => 'ikeja-electric',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                        [
                            'name' => 'EKEDC',
                            'shortcode' => 'eko-electric',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                        [
                            'name' => 'KEDCO',
                            'shortcode' => 'kano-electric',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                        [
                            'name' => 'PHED',
                            'shortcode' => 'portharcourt-electric',
                            'cashback' => 0.5,
                            'cashback_type' => 'percent',
                        ],
                    ]
                ]
            ]
        ],
        [
            'name' => 'Education',
            'shortcode' => 'education',
        ],
    ],

    'payment_providers' => [
        [
            'name' => 'Wallet',
            'shortcode' => PaymentMethods::WALLET,
            'image' => '',
            'countries' => ['NG', 'GH', 'US'],
            'mode' => 'live',
            'isOnline' => false
        ],
        [
            'name' => 'Paystack',
            'shortcode' => PaymentMethods::PAYSTACK,
            'image' => '/storage/public/logos/paystack.png',
            'countries' => ['NG', 'GH'],
            'mode' => 'test',
            'meta' => [
                'PAYSTACK_URL' => env('PAYSTACK_URL'),
                'PAYSTACK_LIVE_SECRET_KEY' => env('PAYSTACK_LIVE_SECRET_KEY'),
                'PAYSTACK_TEST_SECRET_KEY' => env('PAYSTACK_TEST_SECRET_KEY'),
                'PAYSTACK_TEST_PUBLIC_KEY' => env('PAYSTACK_TEST_PUBLIC_KEY'),
                'PAYSTACK_LIVE_PUBLIC_KEY' => env('PAYSTACK_LIVE_PUBLIC_KEY'),
                'PAYSTACK_ENCRYPTION_KEY' => env('PAYSTACK_ENCRYPTION_KEY'),
            ],
            'isOnline' => true
        ],
        [
            'name' => 'Monnify',
            'shortcode' => PaymentMethods::MONNIFY,
            'image' => '',
            'countries' => ['NG'],
            'mode' => 'test',
            'meta' => [
                'MONNIFY_LIVE_URL' => env('MONNIFY_LIVE_URL'),
                'MONNIFY_TEST_URL' => env('MONNIFY_TEST_URL'),
                'MONNIFY_LIVE_API_KEY' => env('MONNIFY_LIVE_API_KEY'),
                'MONNIFY_TEST_API_KEY' => env('MONNIFY_TEST_API_KEY'),
                'MONNIFY_TEST_CONTRACT_CODE' => env('MONNIFY_TEST_CONTRACT_CODE'),
                'MONNIFY_LIVE_CONTRACT_CODE' => env('MONNIFY_LIVE_CONTRACT_CODE'),
                'MONNIFY_LIVE_SECRET_KEY' => env('MONNIFY_LIVE_SECRET_KEY'),
                'MONNIFY_TEST_SECRET_KEY' => env('MONNIFY_TEST_SECRET_KEY'),
            ],
            'isOnline' => true
        ]
    ],

    'virtual_accounts' => [
        'NG' => MonnifyService::class
    ]




];
