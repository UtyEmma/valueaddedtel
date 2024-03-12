<?php

namespace App\Services\Account;

use App\Models\Account\User;
use App\Models\KYC\AccountTier;

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
