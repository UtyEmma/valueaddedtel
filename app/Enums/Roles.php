<?php

namespace App\Enums;

enum Roles:string {

    case USER  = 'user' ;
    case ADMIN = 'admin';
    case SUPERADMIN = 'superadmin';
    case ALLUSERS = 'all_users';
}
