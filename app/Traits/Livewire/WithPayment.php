<?php

namespace App\Traits\Livewire;

use App\Models\Transactions\Transaction;
use App\Services\TransactionService;

trait WithPayment {

    public Transaction $transaction;

    function cancel(){
        $this->step = 1;
        $this->toast('If you are encountering any challenges, please contact our support center', 'Purchase Cancelled')->warning();
        return $this->js("$('#confirm-modal').modal('hide')");
    }

    function complete(){

    }

    function pay(){
        $rules = $this->rules();

        $this->validate([
            'payment_method' => ['required', 'in:'.implode(',', $this->methods)],
            ...$rules
        ]);

        $this->handle();

        return $this->step = 2;
    }

    function confirm(){
        return $this->js("$('#confirm-modal').modal('show')");
    }

}