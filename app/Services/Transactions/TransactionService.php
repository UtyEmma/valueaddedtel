<?php

namespace App\Services\Transactions;

use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Enums\Services;
use App\Enums\Status;
use App\Enums\TransactionType;
use App\Models\Countries\Currency;
use App\Models\Transactions\PaymentMethod;
use App\Models\Transactions\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionService {

    private function validate($data, $user){
        if(!isset($data['amount'])) {
            return status(false, 'The Transaction amount has not been provided');
        }

        if(!isset($data['payment_method'])) {
            return status(false, 'No Payment method has been selected for this transaction.');
        }

        if(!isset($data['type'])) {
            return status(false, 'The transaction details are invalid.');
        }

        if(!Services::tryFrom($data['type'])) {
            return status(false, 'The transaction details are invalid.');
        }

        $data['amount'] = positiveInt($data['amount']);
        // $data['amount'] = abs(filter_var($data['amount'], FILTER_SANITIZE_NUMBER_INT));

        return status(true, '', collect($data)->only(['amount', 'payment_method', 'type', 'narration'])->toArray());
    }

    private function getPaymentMethod($shortcode, $user){
        if(!$paymentMethod = PaymentMethod::whereShortcode($shortcode)->first()){
            return status(false, "The selected payment method is invalid");
        }

        if($paymentMethod->status != Status::ACTIVE){
            return status(false, "The selected payment method is not available at the moment");
        }

        if(!$paymentMethod->isAvailableInCountry($user->country_code)) {
            return status(false, "The selected payment method is not available in your country");
        }

        return status(true, '', $paymentMethod);
    }

    private function getPaymentClass($transaction){
        $payment_methods = config('providers.payments');
        $paymentMethod = $transaction->paymentMethod->shortcode->value;
        return new $payment_methods[$paymentMethod];
    }

    function create($data, TransactionType $flow, User $user = null, $state = PaymentStatus::PENDING){
        $user = $user ?? authenticated();

        [$status, $message, $data] = $this->validate($data, $user);
        if(!$status) return status($status, $message, $data);

        [$status, $message, $paymentMethod] = $this->getPaymentMethod($data['payment_method'], $user);
        if(!$status) return status($status, $message);

        $transaction = Transaction::create([
            ...$data,
            'payment_method_code' => $paymentMethod->shortcode,
            'currency_code' => $user->currency->code,
            'user_id' => $user->id,
            'reference' => $this->reference(),
            'flow' => $flow,
            'status' => $state
        ]);

        return status(true, '', $transaction);
    }

    function reference(){
        $reference = Str::random();
        if(Transaction::where('reference', $reference)->exists()) return $this->reference();
        return $reference;
    }

    function verify($transaction){
        if(!$transaction) return status(false, 'The transaction does not exist');
        $payment = $this->getPaymentClass($transaction);

        try {
            [$status, $message, $data] = $payment->verify($transaction->reference);
        } catch (\Throwable $th) {
            return status(false, $th->getMessage());
        }

        if(!$status) return status(false, $message, $transaction);

        $transaction->status = $message;
        $transaction->save();

        if($transaction->status == PaymentStatus::SUCCESS) return status(true, PaymentStatus::SUCCESS, $transaction);
        if($transaction->status == PaymentStatus::FAILED) return status(false, PaymentStatus::FAILED, $transaction);
    }

    function init(Transaction $transaction) {
        $payment = $this->getPaymentClass($transaction);
        [$status, $message, $data] = $payment->initiate($transaction);

        if(!$status) {
            $transaction->delete();
            return status($status, $message, $data);
        }

        return status(true, $message, [$transaction, $data]);
    }

    function cancel($transaction){
        $transaction->delete();
    }

}
