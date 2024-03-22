<?php

namespace App\Services\Transactions;

use App\Enums\Status;
use App\Models\Services\Service;
use App\Models\Transactions\VtuHistory;

class PurchaseService {

    function validate($data){
        $data = collect($data);

        if(!isset($data['service_code'])) {
            return status(false, 'No Service Provider is provided for this purchase.');
        }

        if(!$service = Service::where('shortcode', $data['service_code'])->first()){
            return status(false, 'The selected service provider is invalid.');
        }

        if($service->status == Status::INACTIVE){
            return status(false, 'The selected service provider is invalid.');
        }
    }

    function create($data, $user, $transaction){
        $purchase = VtuHistory::class;


        // amount
        // service_code
        // provider_code
        // country_code
        // currency_code
        // narration
        // mode
        // data
        // status
    }

    function purchase(){

    }

    function verify(){

    }

}
