<?php

namespace App\Enums;

enum ConfirmationActions:string {

    case PASSWORD_RESET = 'Reset Password';
    case UPDATE_EMAIL = 'Update Email Address';

}
