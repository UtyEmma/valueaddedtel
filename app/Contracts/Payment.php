<?php

namespace App\Contracts;

use App\Models\Payment\Transaction;
use Closure;

interface Payment {

    function pay(Transaction $transaction);
    function query(string | Closure $reference);

    function verify(string | Closure $reference);

}

