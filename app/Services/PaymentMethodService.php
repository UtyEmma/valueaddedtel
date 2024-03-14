<?php

namespace App\Services;

class PaymentMethodService {

    private $user;

    public function __construct($user = null) {
        $this->user = $user ?? authenticated();
    }

}
