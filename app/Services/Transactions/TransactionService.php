<?php

namespace App\Services\Transactions;

use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Enums\Status;
use App\Models\Countries\Currency;
use App\Models\Transactions\PaymentMethod;
use App\Models\Transactions\Transaction;
use App\Models\User;
use Illuminate\Support\Str;

class TransactionService {

    private function validate($data, $user){
        if(!isset($data['amount'])) {
            return status(false, 'The Transaction amount has not been provided');
        }

        if(!isset($data['payment_method'])) {
            return status(false, 'No Payment method has been selected for this transaction.');
        }

        if(!$paymentMethod = $this->getPaymentMethod($data['payment_method'])){
            return status(false, "The selected payment method is invalid");
        }

        if($paymentMethod->status != Status::ACTIVE){
            return status(false, "The selected payment method is not available at the moment");
        }

        if(!$paymentMethod->isAvailableInCountry($user->country_code)) {
            return status(false, "The selected payment method is not available in your country");
        }

        $data['amount'] = abs(filter_var($data['amount'], FILTER_SANITIZE_NUMBER_INT));

        return status(true, '', collect($data)->only(['amount', 'payment_method'])->toArray());
    }

    private function getPaymentMethod($shortcode){
        return PaymentMethod::whereShortcode($shortcode)->first();
    }

    function create($data, User $user = null, $status = PaymentStatus::PENDING){
        $user = $user ?? authenticated();

        [$status, $message, $data] = $this->validate($data, $user);
        if(!$status) return status($status, $message, $data);

        $transaction = Transaction::create([
            ...$data,
            'currency' => $user->currency->code,
            'user_id' => $user->id,
            'reference' => $this->reference(),
            'status' => $status
        ]);

        return status(true, '', $transaction);
    }

    function reference(){
        $reference = Str::random();
        if(Transaction::where('reference', $reference)->exists()) return $this->reference();
        return $reference;
    }

    function verify(Transaction $transaction){

    }

    function init(Transaction $transaction) {
        $payment_methods = config('payments.methods');
        $payment = new $payment_methods[$transaction->paymentMethod->shortcode]();
        return $payment->init();
    }

}
