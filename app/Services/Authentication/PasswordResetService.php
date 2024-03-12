<?php

namespace App\Services\Authentication;

use App\Enums\ConfirmationActions;
use App\Models\Account\User;
use App\Services\ConfirmationCodeService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetService {

    function initiate(User $user){
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        app(ConfirmationCodeService::class)
            ->create($user, ConfirmationActions::PASSWORD_RESET)
            ->send($user->email);

        return status(true, "Password reset code has been sent to ".$user->email);
    }

    function reset(User $user, $data){
        (new ConfirmationCodeService)->use($user, $data['token']);

        $user->forceFill([
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(60),
        ])->save();
    }

}
