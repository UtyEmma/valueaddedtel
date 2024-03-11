<?php

namespace App\Services\PaymentMethods;

use App\Contracts\Payment;
use App\Enums\PaymentStatus;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PaystackService implements Payment {

    private $api;

    function __construct(){
        $this->api = Http::baseUrl(env('PAYSTACK_URL'))
                        ->withToken(env('PAYSTACK_SECRET_KEY'))
                        ->acceptJson()
                        ->asJson();
    }

    function resolve(Response $req){
        if($req->ok()) {
            $data = $req->json();
            if(!$data['status']) return [PaymentStatus::FAILED];
            return [PaymentStatus::PENDING, $data];
        }
        return [PaymentStatus::FAILED];
    }

    function pay($transaction){
        $data = [
            'email' => $transaction->payer->email,
            'amount' => $transaction->amount * 100,
            'reference' => $transaction->reference,
            'metadata' => [
                'transaction' => $transaction->id
            ],
            'callback_url' => '',
            'currency' => $transaction->currency
        ];

        return $this->resolve($this->api->post('transaction/initialize', $data));
    }

    function inline($transaction){
        $data = [
            'key' => env('PAYSTACK_PUBLIC_KEY'),
            'email' => $transaction->payer->email,
            'amount' => $transaction->amount * 100,
            'ref' => $transaction->reference,
            'currency' => $transaction->currency
        ];

        return $data;
    }

    function verify($reference){
        return $this->resolve($this->api->get("transaction/verify/$reference"));
    }

    function query($id){
        return $this->resolve($this->api->get("transaction/$id"));
    }

    function banks($country = null){
        return $this->resolve($this->api->get('bank', ['country' => $country]));
    }

    function countries(){
        return $this->resolve($this->api->get('country'));
    }

    function resolveAccountNumber($bank_code, $account_no){
        return $this->resolve($this->api->get("resolve?account_number=$account_no&bank_code=$bank_code"));
    }

}
