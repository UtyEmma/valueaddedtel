<?php

namespace App\Services;

use App\Models\Package;
use App\Models\User;

class PackageService {

    function setDefault(User $user){
        $package = Package::isDefault()->first();
        $user->package_id = $package->id;
        $user->save();

        $this->saveHistory($user, $package);
    }

    function saveHistory(User $user, Package $package){
        $user->packageHistory()->create([
            'package_id' => $package->id,
            'fee' => $package->fee,
            'currency_code' => $user->currency?->code
        ]);
    }

}
