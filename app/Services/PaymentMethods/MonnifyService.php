<?php

namespace App\Services\PaymentMethods;

use App\Enums\PaymentMethods;
use App\Enums\Status;
use App\Library\Token;
use App\Models\Services\ServiceProvider;
use App\Models\Transactions\PaymentMethod;
use App\Models\User;
use App\Models\VirtualAccount;
use App\Traits\Generics;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class MonnifyService {
    private $authKey;
    public $api;
    public $token;
    public $keys;

    private PaymentMethod $paymentMethod;

    public function __construct() {

        $this->paymentMethod = PaymentMethod::whereName(PaymentMethods::MONNIFY)->first();
        $keys = $this->setKeys();

        $authKey = implode(':', [$this->keys['API_KEY'], $this->keys['SECRET_KEY']]);
        // dd($keys, $authKey);

        $this->api = Http::withHeaders([
            "Authorization" => "Basic ".base64_encode($authKey),
        ])->baseUrl($this->keys['URL']);
    }

    function setKeys(){
        $meta = $this->paymentMethod->meta;

        if($this->paymentMethod->is_live_mode) {
            $this->keys = [
                'URL' => $meta['MONNIFY_LIVE_URL'],
                'API_KEY' => $meta['MONNIFY_LIVE_API_KEY'],
                'CONTRACT_CODE' => $meta['MONNIFY_LIVE_CONTRACT_CODE'],
                'SECRET_KEY' => $meta['MONNIFY_LIVE_SECRET_KEY']
            ];
        }

        if($this->paymentMethod->is_test_mode) {
            $this->keys = [
                'URL' => $meta['MONNIFY_TEST_URL'],
                'API_KEY' => $meta['MONNIFY_TEST_API_KEY'],
                'CONTRACT_CODE' => $meta['MONNIFY_TEST_CONTRACT_CODE'],
                'SECRET_KEY' => $meta['MONNIFY_TEST_SECRET_KEY']
            ];
        }

        return $this->keys;
    }

    private function login(){
        $response = $this->api->post('/api/v1/auth/login');

        if(!$response->ok()) return status(false, 'Your request could not be completed at the moment!');
        $data = $response->object();

        if(!$data->requestSuccessful || $data->responseMessage != 'success') {
            return status(false, "Your request could not be completed at the moment!");
        }

        return status(true, '', $data->responseBody->accessToken);
    }

    private function authorize($token){
        return $this->api->withHeaders([
            "Authorization" => "Bearer ".$token,
            "Content-Type" => 'application/json'
        ]);
    }

    function reserve(User $user){
        [$status, $message, $token] = $this->login();
        if(!$status) return status($status, $message);

        $reference = (new Token)->numeric(VirtualAccount::class, 'reference');

        $response = $this->authorize($token)->post('/api/v2/bank-transfer/reserved-accounts', [
            "accountReference" => $reference,
            "accountName" => $user->full_name,
            "currencyCode" => "NGN",
            "contractCode" => $this->keys['CONTRACT_CODE'],
            "customerEmail" => $user->email,
            "customerName" => $user->full_name,
            "getAllAvailableBanks" => false,
            'preferredBanks' => config('monnify.preferred_banks')
        ]);

        if(!$response->ok()) return status(false, "Your request could not be completed at the moment!");
        $data = $response->object();

        if(!$data->requestSuccessful || $data->responseMessage !== 'success') {
            return status(false, "Your request could not be completed at the moment!");
        }

        $responseBody = $data->responseBody;
        $accounts = $this->mapAccounts($user, $responseBody);

        return status(true, '', $accounts);
    }

    function mapAccounts ($user, $data){
        $accounts = $data->accounts;

        return array_map(function($item) use($data, $user) {
            return [
                'country_code' => $user->country_code,
                'status' => Status::ACTIVE,
                'bank' => $item->bankName,
                'account_name' => $item->accountName,
                'account_no' => $item->accountNumber,
                "reference" => $data->accountReference,
                'meta' => [
                    'reservationReference' => $data->reservationReference,
                    "bankCode" => $item->bankCode,
                ]
            ];
        }, $accounts);
    }

    function account($reference){
        [$status, $message, $token] = $this->login();
        if(!$status) return status($status, $message);

        $response = $this->authorize($token)->get('/api/v1/bank-transfer/reserved-accounts/'.$reference);

        if(!$response->ok()) return status(false,  "Your request could not be completed at the moment!");
        $data = $response->object();

        if(!$data->requestSuccessful || $data->responseMessage !== 'success') return status(false,  "Your request could not be completed at the moment!");;
        return status(true, "", $data);
    }

    function verifyBVN($user, $data){
        [$status, $message, $token] = $this->login();
        if(!$status) return status($status, $message);

        $response = $this->authorize($token)->post('api/v1/vas/bvn-details-match', [
            "bvn" => $data['bvn'],
            "name" => $user->full_name,
            "dateOfBirth" => $data['dateOfBirth'],
            "mobileNo" => $user->phone
        ]);

        if(!$response->ok()) return status(false,  "Your request could not be completed at the moment!");
        $data = $response->object();
        if(!$data->requestSuccessful || $data->responseMessage !== 'success') return status(false,  "Your request could not be completed at the moment!");

        $responseBody = $data->responseBody;
        $matchStatus = $responseBody->name->matchStatus;

        if($matchStatus === 'NO_MATCH') return status(false, "The name did not match!");
        if($matchStatus === 'PARTIAL_MATCH' || $matchStatus === 'FULL_MATCH') return status(true, "Matched");
    }

}
