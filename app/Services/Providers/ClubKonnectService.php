<?php

namespace App\Services\Providers;

use App\Enums\ServiceProviders;
use App\Enums\Services;
use App\Models\Services\ServiceProvider;
use App\Models\Transactions\Purchase;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ClubKonnectService {

    private $api;
    private $provider;

    protected $meta = [];
    protected $purchase;

    private $successCodes = [200, 201];
    private $pendingCodes = [201, ];

    function __construct(Purchase $purchase){
        $this->purchase = $purchase;

        $this->provider = ServiceProvider::whereShortcode(ServiceProviders::CLUBKONNECT)->first();
        $this->meta = $this->provider->meta;
        $this->api =  Http::baseUrl($this->meta['CLUB_KONNECT_URL']);
    }

    function resolve(Response $res) {
        if($res->failed()) throw new \Exception('Your request could not be completed');
        $data = $res->json();
        dd($data);

        return status(true);
    }

    function handle(){
        try {
            $res = match ($this->purchase->service->shortcode) {
                Services::AIRTIME => $this->airtime($this->purchase)
            };
        } catch (\Throwable $th) {
            return status(false, $th->getMessage());
        }

        return $this->resolve($res);
    }

    function airtime(){
        return $this->api->get('/APIAirtimeV1.asp', [
            'UserID' => $this->purchase->provider->meta['CLUB_KONNECT_USER'],
            'APIKey' => $this->purchase->provider->meta['CLUB_KONNECT_KEY'],
            'MobileNetwork' => $this->purchase->meta['network'],
            'Amount' => $this->purchase->amount,
            'MobileNumber' => $this->purchase->meta['phone'],
            'RequestID' => $this->purchase->reference,
            // 'CallBackURL' => route('rechargepins.callback')
        ]);
    }


}
