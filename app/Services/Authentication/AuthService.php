<?php

namespace App\Services\Authentication;

use App\Models\Country;
use App\Models\Currency;
use App\Models\User;
use App\Services\CountryService;
use App\Services\KYCService;
use App\Services\PackageService;
use App\Services\ReferralService;
use Illuminate\Http\Request;
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
        $country = Country::find($data['country']);
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
