<?php

namespace App\Services;

use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Models\Currency;
use App\Models\Payment\Transaction;
use App\Services\PaymentMethods\PaystackService;
use Illuminate\Support\Str;

class TransactionService {

    function create($transactable, $user, $data, $status = PaymentStatus::PENDING){
        $currency = session('currency');

        $currency = Currency::find($currency->id);

        $transaction = new Transaction([
            ...$data,
            'currency' => $currency->code,
            'reference' => $this->reference(),
            'amount' => $transactable->amount,
            'status' => $status
        ]);

        $transaction->transactable()->associate($transactable);
        $transaction->user()->associate($user);
        $transaction->save();
        $transaction->refresh();
        return $transaction;
    }

    function reference(){
        $reference = Str::random();
        if(Transaction::where('reference', $reference)->exists()) return $this->reference();
        return $reference;
    }

    function init(Transaction $transaction){
        return $transaction->paymentMethod->init();
    }

}
