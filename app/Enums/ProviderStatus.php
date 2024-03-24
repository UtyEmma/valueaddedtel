<?php

namespace App\Enums;

enum ProviderStatus:string {

    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case DELAYED = 'DELAYED';

}
