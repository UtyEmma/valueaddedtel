<?php

namespace App\Services\Providers;

use App\Enums\ServiceProviders;

class VtPassService {

    function __construct() {
        $instance = ServiceProviders::instance(ServiceProviders::VTPASS);
    }

}
