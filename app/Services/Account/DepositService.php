<?php

namespace App\Services\Account;

use App\Enums\Services;
use App\Models\Services\Service;

class DepositService {

    private $user;
    private $shortcode = Services::DEPOSIT;
    public Service $service;

    public function __construct($user = null) {
        $this->user = $user ?? authenticated();
        $this->service = Service::whereShortcode($this->shortcode)->first();
    }

    function paymentMethods($country_code = null){
        return $this->service->paymentMethods()
                ->isActive('payment_methods.status')
                ->whereHas('countries',
                    fn($query) => $query->isActive('countries.status')->where('iso_code', $country_code ?? $this->user->country_code)
                )
                ->get();
    }

    function initiate(){

    }

}
