<?php

namespace App\Enums;

enum Roles:string {

    case MERCHANT  = 'merchant' ;
    case CUSTOMER = 'customer';
    case ADMIN = 'admin';
    case SUPERADMIN = 'superadmin';
    case ALLUSERS = 'all_users';
}
