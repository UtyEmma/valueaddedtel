<?php

namespace App\Services;

use App\Models\Services\Service;
use App\Models\User;

class PaymentMethodService {

    private $user;

    public function __construct($user = null) {
        $this->user = $user ?? authenticated();
    }

    function service(Service $service){
        return $service->methods()->pluck('payment_method_code')->toArray();
    }

}
