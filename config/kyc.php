<?php

return [

    "tiers"=> [
        [
            'name' => 'Level One',
            'level' => 1,
            'max_balance' => 10000,
            'max_deposit' => 5000,
            'max_withdrawal' => 5000,
            'is_default' => true
        ],

        [
            'name' => 'Level Two',
            'level' => 2,
            'max_balance' => 20000,
            'max_deposit' => 10000,
            'max_withdrawal' => 10000,
            'is_default' => false
        ],

        [
            'name' => 'Level Three',
            'level' => 3,
            'max_balance' => 30000,
            'max_deposit' => 20000,
            'max_withdrawal' => 20000,
            'is_default' => false
        ],
    ],

];
