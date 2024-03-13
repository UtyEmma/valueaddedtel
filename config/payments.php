<?php

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
            'test_data' => [
                'url' => '',
                'key' => ''
            ],
            'live_data' => [
                'url' => '',
                'key' => ''
            ],
            'mode' => 'test',
            'meta' => []
        ],

        'topupaccess' => [
            'class' => TopUpAccessService::class,
            'name' => 'Top Up Access',
            'countries' => ['NG'],
            'shortcode' => 'topupaccess',
            'test_data' => [
                'url' => '',
                'key' => ''
            ],
            'live_data' => [
                'url' => '',
                'key' => ''
            ],
            'mode' => 'test',
            'meta' => []
        ],

        'clubkonnect' => [
            'class' => VtPassService::class,
            'name' => 'Club Konnect',
            'countries' => ['NG'],
            'shortcode' => 'clubkonnect',
            'test_data' => [
                'url' => '',
                'key' => ''
            ],
            'live_data' => [
                'url' => '',
                'key' => ''
            ],
            'mode' => 'test',
            'meta' => []
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
            'shortcode' => 'wallet',
            'image' => '',
            'countries' => ['NG', 'GH', 'US']
        ],
        [
            'name' => 'Paystack',
            'shortcode' => 'paystack',
            'image' => '/storage/public/logos/paystack.png',
            'countries' => ['NG', 'GH']
        ],
    ]



];
