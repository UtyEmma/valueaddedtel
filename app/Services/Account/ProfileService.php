<?php

namespace App\Services\Account;

use App\Enums\ConfirmationActions;
use App\Models\User;
use App\Services\ConfirmationCodeService;
use Illuminate\Support\Facades\Hash;

class ProfileService {

    function updatePin(User $user, $data) {
        if(Hash::check($data['pin'], $user->pin)) {
            return status(false, 'This pin has been used previously by you. Please set a different pin.');
        }

        $user->pin = Hash::make($data['pin']);
        $user->save();

        return status(true, 'Pin Updated Successfully');
    }

    function updatePassword(User $user, $password) {
        if(Hash::check($password, $user->password)) {
            return status(false, 'This pin has already been used. Please set a different password');
        }

        $user->pin = Hash::make($password);
        $user->save();

        return status(true, 'Password Updated Successfully');
    }

    function updateProfile(User $user, $data) {
        $user->fill($data);
        $user->save();

        return status(true, 'Profile Information updated Successfully!');
    }

    function initiateEmailUpdate(User $user, $data) {
        (new ConfirmationCodeService)
            ->create($user, ConfirmationActions::UPDATE_EMAIL)
            ->send($data['email']);

        return status(true, 'Email Address Confirmation Code Sent.');
    }

    function updateEmail(User $user, $data){
        (new ConfirmationCodeService)->use($user, $data['code']);

        $user->fill($data);
        $user->save();

        return status(true, 'Email Address updated Successfully!');
    }

}
