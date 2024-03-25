<?php

namespace App\Services\Account;

use App\Enums\PaymentStatus;
use App\Enums\TransactionType;
use App\Models\Transactions\Transaction;
use App\Models\Wallet;

class WalletService {

    function charge(Wallet $wallet, $amount, $column = 'main_bal'){
        // if($amount < 1) return status(false, 'The requested amount was invalid! Please input a valid amount.');
        $amount = positiveInt($amount);
        if($wallet[$column] < $amount) return status(false, 'Insufficient Funds. Please fund your wallet.');

        $wallet[$column] -= $amount;
        $wallet->save();

        return status(true);
    }

    function fund(Wallet $wallet, $amount, $column = 'main_bal'){
        $amount = positiveInt($amount);
        $wallet[$column] += $amount;
        $wallet->save();

        return status(true);
    }

    function fulfill(Wallet $wallet, Transaction $transaction, $column = 'main_bal'){
        $transaction->old_bal = $wallet[$column];

        if($transaction->flow == TransactionType::DEBIT) {
            [$status, $message] = $this->charge($wallet, $transaction->amount, $column);
        }

        if($transaction->flow == TransactionType::CREDIT) {
            [$status, $message] = $this->fund($wallet, $transaction->amount, $column);
        }

        if(!$status) return status($status, $message);

        $wallet = $wallet->refresh();

        $transaction->new_bal = $wallet[$column];
        $transaction->status = PaymentStatus::SUCCESS;
        $transaction->save();

        return status(true);
    }



}
