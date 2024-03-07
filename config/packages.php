<?php

use App\Enums\Status;

return [

    'list' => [
        [
            'name' => 'Free Class',
            'fee' => 0,
            'bonus' => 0,
            'max_level' => 0,
            'point_value' => 0,
            'status' => Status::ACTIVE,
            'is_default' => true
        ],

        [
            'name' => 'O Level Class',
            'fee' => 1000,
            'bonus' => 150,
            'max_level' => 1,
            'point_value' => 2,
            'status' => Status::ACTIVE,
            'is_default' => false
        ],

        [
            'name' => 'Pre Degree Class',
            'fee' => 2500,
            'bonus' => 375,
            'max_level' => 2,
            'point_value' => 5,
            'status' => Status::ACTIVE,
            'is_default' => false
        ],

        [
            'name' => 'Pass Class',
            'fee' => 5000,
            'bonus' => 750,
            'max_level' => 4,
            'point_value' => 10,
            'status' => Status::ACTIVE,
            'is_default' => false
        ],

        [
            'name' => '3rd Class',
            'fee' => 10000,
            'bonus' => 1500,
            'max_level' => 5,
            'point_value' => 20,
            'status' => Status::ACTIVE,
            'is_default' => false
        ],

        [
            'name' => '2nd Class',
            'fee' => 20000,
            'bonus' => 3000,
            'max_level' => 6,
            'point_value' => 50,
            'status' => Status::ACTIVE,
            'is_default' => false
        ],

        [
            'name' => '1st Class',
            'fee' => 30000,
            'bonus' => 4500,
            'max_level' => 7,
            'point_value' => 60,
            'status' => Status::ACTIVE,
            'is_default' => false
        ],

        [
            'name' => 'Business Class',
            'fee' => 40000,
            'bonus' => 6000,
            'max_level' => 8,
            'point_value' => 80,
            'status' => Status::ACTIVE,
            'is_default' => false
        ],

        [
            'name' => 'VIP Class',
            'fee' => 50000,
            'bonus' => 7500,
            'max_level' => 10,
            'point_value' => 100,
            'status' => Status::ACTIVE,
            'is_default' => false
        ],

        [
            'name' => 'Ambassador Class',
            'fee' => 100000,
            'bonus' => 15500,
            'max_level' => 10,
            'point_value' => 200,
            'status' => Status::ACTIVE,
            'is_default' => false
        ],
    ]

];
