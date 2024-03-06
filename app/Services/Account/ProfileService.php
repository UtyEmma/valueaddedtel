<?php

namespace App\Services\Account;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService {

    function updatePin(User $user, $data) {
        if(Hash::check($data['pin'], $user->pin)) {
            return status(false, 'You cannot set your pin to an already existing pin');
        }

        $user->pin = Hash::make($data['pin']);
        $user->save();

        return status(true, 'Pin Updated Successfully');
    }

}
