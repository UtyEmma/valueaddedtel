<?php

namespace App\Services\Transactions;

use App\Enums\ServiceProviders;
use App\Enums\Status;
use App\Library\Token;
use App\Models\Services\Service;
use App\Models\Services\ServiceProduct;
use App\Models\Services\ServiceProductItem;
use App\Models\Services\ServiceProvider;
use App\Models\Transactions\Purchase;
use App\Models\Transactions\VtuHistory;
use App\Models\User;

class PurchaseService {

    protected User $user;
    protected Service $service;

    function __construct(Service $service, User $user = null, ) {
        $this->service = $service;
        $this->user = $user ?? authenticated();
    }

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

    function create(ServiceProvider $serviceProvider, ServiceProduct $product, $amount, $meta, ServiceProductItem $serviceProductItem = null) {
        $user = $this->user;
        $reference = (new Token)->numeric(Purchase::class, 'refrence');

        $purchase = $user->purchases()->create([
            'amount' => $amount,
            'meta' => $meta,
            'reference' => $reference,
            'narration' => $meta['narration'],
            'country_code' => $user->country_code,
            'currency_code' => $user->currency_code,
            'provider_code' => $serviceProvider->shortcode,
            'service_code' => $this->service->shortcode,
            'product_code' => $product->shortcode,
            'product_item_code' => $serviceProductItem?->shortcode
        ]);

        return status(true, '', $purchase);
    }

    function purchase(Purchase $purchase){
        $instance = ServiceProviders::instance($purchase->provider->shortcode);
        // return
    }

    function verify(){

    }

}
