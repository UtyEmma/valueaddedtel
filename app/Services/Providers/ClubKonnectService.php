<?php

namespace App\Services\Providers;

use App\Enums\ServiceProviders;
use App\Models\Services\ServiceProvider;
use App\Models\Transactions\VtuHistory;
use Illuminate\Support\Facades\Http;

class ClubKonnectService {

    private $api;
    private $provider;

    private $meta = [];

    // public $networks = [
    //     'MTN' => '01',
    //     'GLO' => '02',
    //     'ETISALAT' => '03',
    //     'AIRTEL' => '04'
    // ];


    function __construct(){
        $this->provider = ServiceProvider::whereShortcode(ServiceProviders::CLUBKONNECT)->first();
        $this->meta = $this->provider->meta;
        $this->api =  Http::baseUrl();
    }

    function airtime($vtuHistory, $amount, $phoneNo, $requestId){
        // $services = $this->rechargePinServices();
        $data = $vtuHistory->data;
        $req = $this->api->get('/APIAirtimeV1.asp', [
            'UserID' => $this->meta['CLUB_KONNECT_USER'],
            'APIKey' => $this->meta['CLUB_KONNECT_KEY'],
            'MobileNetwork' => $data['network'],
            'Amount' => $vtuHistory->amount,
            'MobileNumber' => $vtuHistory['phone'],
            'RequestID' => $vtuHistory->reference,
            'CallBackURL' => route('rechargepins.callback')
        ]);

        if(!$req->ok()) {
            return status(false, '');
        }

        $data = $req->json();
        return true;
    }


}
