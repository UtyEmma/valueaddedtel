<?php

namespace App\Services\Account;

use App\Models\AccountTier;
use App\Models\User;

class KYCService {

    function setDefaultTier(User $user){
        $tier = AccountTier::isDefault()->first();
        $user->tier_id = $tier->id;
        $user->save();
    }

    function setTier(User $user, AccountTier $tier){
        $user->tier_id = $tier->id;
        $user->save();
    }

}
