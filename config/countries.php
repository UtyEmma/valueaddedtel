<?php

return [

    'list' => [
        [
            'name' => 'Andorra',
            'flag' => '/assets/media/flags/andorra.svg',
            'iso_code' => 'AD',
            'iso_alpha_3' => 'AND',
            'intl_phone' => '376',
        ],

        [
            'name' => 'United Arab Emirates',
            'flag' => '/assets/media/flags/united-arab-emirates.svg',
            'iso_code' => 'AD',
            'iso_alpha_3' => 'ARE',
            'intl_phone' => '971'
        ],

        [
            'name' => 'Afghanistan',
            'flag' => 'assets/media/flags/afghanistan.svg',
            'iso_code' => 'AF',
            'iso_alpha_3' => 'AFG',
            'intl_phone' => '93'
        ],

        [
            'name' => 'Antigua and Barbuda',
            'flag' => 'assets/media/flags/afghanistan.svg',
            'iso_code' => 'AG',
            'iso_alpha_3' => 'ATG',
            'intl_phone' => '1-268'
        ],

        [
            'name' => 'Anguilla',
            'flag' => 'assets/media/flags/anguilla.svg',
            'iso_code' => 'AI',
            'iso_alpha_3' => 'AIA',
            'intl_phone' => '1-264'
        ],

        [
            'name' => 'Albania',
            'flag' => 'assets/media/flags/albania.svg',
            'iso_code' => 'AL',
            'iso_alpha_3' => 'ALB',
            'intl_phone' => '355'
        ],

        [
            'name' => 'Armenia',
            'flag' => 'assets/media/flags/armenia.svg',
            'iso_code' => 'AM',
            'iso_alpha_3' => 'ARM',
            'intl_phone' => '374'
        ],

        [
            'name' => 'Angola',
            'flag' => 'assets/media/flags/angola.svg',
            'iso_code' => 'AO',
            'iso_alpha_3' => 'AGO',
            'intl_phone' => '244'
        ],

        [
            'name' => 'Argentina',
            'flag' => 'assets/media/flags/argentina.svg',
            'iso_code' => 'AR',
            'iso_alpha_3' => 'ARG',
            'intl_phone' => '54'
        ],

        [
            'name' => 'Argentina',
            'flag' => 'assets/media/flags/argentina.svg',
            'iso_code' => 'AR',
            'iso_alpha_3' => 'ARG',
            'intl_phone' => '54'
        ],
    ],

    'supported' => [
        [
            'name' => 'Nigeria',
            'flag' => 'assets/media/flags/nigeria.svg',
            'iso_code' => 'NG',
            'iso_code_3' => 'NGR',
            'intl_phone' => '234',
            'is_default' => true
        ],

        [
            'name' => 'Ghana',
            'flag' => 'assets/media/flags/ghana.svg',
            'iso_code' => 'GH',
            'iso_code_3' => 'GHA',
            'intl_phone' => '233',
            'is_default' => false
        ],

        [
            'name' => 'United States of America',
            'flag' => 'assets/media/flags/united-states.svg',
            'iso_code' => 'US',
            'iso_code_3' => 'USA',
            'intl_phone' => '1',
            'is_default' => false
        ],
    ],

    'currencies' => [
        [
            'name' => 'Nigerian Naira',
            'symbol' => '₦',
            'code' => 'NGN',
            'country_code' => 'NG',
            'is_default' => true,
            'rate' => 1500
        ],
        [
            'name' => 'Ghanian Cedi',
            'symbol' => 'GH₵',
            'code' => 'GHS',
            'country_code' => 'GH',
            'is_default' => false,
            'rate' => 500
        ],
        [
            'name' => 'United States Dollar',
            'symbol' => '$',
            'code' => 'USD',
            'country_code' => 'US',
            'is_default' => false,
            'rate' => 1
        ],
    ]

];
