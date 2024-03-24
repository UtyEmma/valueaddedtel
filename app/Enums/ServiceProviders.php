<?php

namespace App\Enums;

use App\Models\Transactions\Purchase;
use App\Services\Providers\ClubKonnectService;
use App\Services\Providers\TopUpAccessService;
use App\Services\Providers\VtPassService;

enum ServiceProviders:string {

    case CLUBKONNECT = 'clubkonnect';
    case VTPASS = 'vtpass';
    case TOPUPACCESS = 'topupaccess';

    static public function instance(Purchase $purchase){
        return match ($purchase->provider->shortcode) {
            self::CLUBKONNECT->value => new ClubKonnectService($purchase),
            self::TOPUPACCESS->value => new TopUpAccessService($purchase),
            self::VTPASS->value => new VtPassService($purchase),
        };
    }

}
