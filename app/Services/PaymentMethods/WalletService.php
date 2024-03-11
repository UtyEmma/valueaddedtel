<?php

namespace App\Services\PaymentMethods;
use App\Contracts\Payment;
use App\Enums\PaymentStatus;
use App\Models\Payment\Transaction;

class WalletService implements Payment {

    function pay(Transaction $transaction){
        $user = authenticated();
        $wallet = $user->wallet;
        if($transaction->amount < 0) return status(PaymentStatus::FAILED, 'Invalid Transaction Amount');
        if($wallet->amount < $transaction->amount) return status(PaymentStatus::FAILED, 'Insufficient Funds');

        $wallet->amount -= $transaction->amount;
        $wallet->save();

        return status(PaymentStatus::SUCCESS);
    }

    function verify($reference){
        return Transaction::where('refrence', $reference)->first();
    }

    function query($reference){
        return Transaction::where('refrence', $reference)->first();
    }

    function refund(Transaction $transaction){
        $user = authenticated();
        $user->wallet->main_bal += $transaction->amount;
        $user->wallet->save();
    }

}
