<?php

namespace App\Services\Authentication;

use App\Models\Account\User;
use App\Models\Countries\Country;
use App\Services\Account\KYCService;
use App\Services\CountryService;
use App\Services\PackageService;
use App\Services\ReferralService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService {

    function login ($data){

    }

    function register($data) {
        $data["password"] = Hash::make($data["password"]);

        // Create User
        $user = new User($data);
        $user->save();

        // Save Country
        $country = Country::where('iso_code', $data['country'])->first();
        (new CountryService)->setCountry($user, $country->iso_code);
        (new CountryService)->setCurrency($user, $country->currency->code);

        // Save Referrer
        $referrer = User::where('username', $data['referrer'])->first();
        (new ReferralService)->assign($user, $referrer);

        // Set Default Package
        (new PackageService)->setDefault($user);

        //Set Default Tier
        (new KYCService)->setDefaultTier($user);

        // Send Verification Email
        $user->sendVerificationEmail();

        return $user;
    }

    function logout(){
        Auth::logout();
    }

}
