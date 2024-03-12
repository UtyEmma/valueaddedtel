<?php

namespace App\Services\Authentication;

use App\Models\Account\User;

class EmailVerificationService {

    function send(User $user, $resend = false) {
        if ($user->hasVerifiedEmail()) {
            return status(false, 'Email Verification was already completed!');
        }

        $user->sendVerificationEmail();

        return status(true, 'Email verification code '.$resend ? 'resent' : 'sent');
    }

    function verify(User $user, $code){
        if ($user->hasVerifiedEmail()) {
            return status(false, 'Email Verification was already completed!');
        }

        return $user->verifyEmail($code);
    }





}
