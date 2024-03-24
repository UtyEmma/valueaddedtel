<?php

namespace App\Enums;

use App\Services\Providers\ClubKonnectService;
use App\Services\Providers\TopUpAccessService;
use App\Services\Providers\VtPassService;

enum ServiceProviders:string {

    case CLUBKONNECT = 'clubkonnect';
    case VTPASS = 'vtpass';
    case TOPUPACCESS = 'topupaccess';

    static public function instance($key){
        return match ($key) {
            self::CLUBKONNECT => new ClubKonnectService,
            self::TOPUPACCESS => new TopUpAccessService,
            self::VTPASS => new VtPassService,
        };
    }

}
