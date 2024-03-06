<?php

namespace App\Services\Account;

use App\Models\Wallet;

class WalletService {

    function charge(Wallet $wallet, $amount, $column = 'main_bal'){
        if($amount < 1) return status(false, 'The requested amount was invalid! Please input a valid amount.');
        if($wallet[$column] < $amount) return status(false, 'Insufficient Funds. Please fund your wallet.');

        $wallet[$column] -= $amount;
        $wallet->save();

        return status(true);
    }

    function fund(Wallet $wallet, $amount, $column = 'main_bal'){
        $wallet[$column] += $amount;
        $wallet->save();

        return status(true);
    }



}
