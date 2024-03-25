<?php

namespace App\Services\Providers;

use App\Enums\PaymentStatus;
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

    private $successCodes = [200, 100, 300, 201, 199];
    private $pendingCodes = [201, 300];

    function __construct(Purchase $purchase){
        $this->purchase = $purchase;

        $this->provider = ServiceProvider::whereShortcode(ServiceProviders::CLUBKONNECT)->first();
        $this->meta = $this->provider->meta;
        $this->api =  Http::baseUrl($this->meta['CLUB_KONNECT_URL'])->timeout(60);
    }

    function resolve($res) {
        // return status(true, PaymentStatus::SUCCESS, ['remark' => 'Test Request no data sent to API']);
        if($res->failed()) throw new \Exception($res->throw());

        $data = $res->json();
        if(!$data) throw new \Exception("No data was returned from the request. Contact API providers for more details");
        ;

        if(isset($data['statuscode'])) {
            $data['remark'] = "Status Code: ".$data['statuscode'].". Status Message: ".$data['status'];
            if(in_array($data['statuscode'], $this->successCodes)) {
                return status(true, PaymentStatus::SUCCESS, $data);
            }

            if(in_array($data['statuscode'], $this->successCodes)) {

                return status(true, PaymentStatus::PENDING, $data);
            }

            return status(true, PaymentStatus::FAILED, $data);
        }

        if(isset($data['status'])) {
            $data['remark'] = "Status Message: ".$data['status'];
            return status(true, PaymentStatus::FAILED, $data);
        }

        throw new \Exception("No transaction status code was returned by Club Konnect. Contact API Provider");
    }

    function handle(){
        try {
            $res = match ($this->purchase->service->shortcode) {
                Services::AIRTIME => $this->airtime($this->purchase)
            };

            return $this->resolve($res);
        } catch (\Throwable $th) {
            $data = [
                'remark' => $th->getMessage()
            ];
            return status(false, $this->provider->mode == 'test' ? $th->getMessage() : 'Your request could not be completed at the moment! Please try again later.', $data);
        }
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
