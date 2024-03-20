<?php

namespace App\Services;

use App\Models\User;

class ReferralService {

    function assign(User $user, User $referrer = null){
        if($referrer) {
            $user->referrer_id = $referrer->id;
        }else{
            $referrer = User::superAdmin()->first();
            $user->referrer_id = $referrer->id;
        }

        $user->save();
    }

    function downlines(User $user){
        // dd($user->downlines);
    }

}
