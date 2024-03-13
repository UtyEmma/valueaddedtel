<?php

namespace App\Services;

use App\Models\Countries\Country;
use App\Models\Countries\Currency;
use App\Models\User;

class CountryService {

    function set(User $user = null) {
        $user = $user ?? authenticated();
        $country = Country::isDefault()->first();
        $currency = Currency::isDefault()->first();

        if($user) {
            $country = $user->country;
            $currency = $user->currency;
        }else{
            // Fetch the user's country and determine the currency from there
        }

        session([
            'currency' => $currency,
            'country' => $country
        ]);

        return $country;
    }


    function setCountry(User $user, $code) {
        if(!$country = Country::where('iso_code', $code)->first()) return false;
        $user->country_code = $country->iso_code;
        $user->save();
        return $user;
    }

    function setCurrency(User $user, $code = null){
        if($currency = Currency::where('code', $code)->first()) {
            $user->currency_code = $currency->code;
        }else{
            $currency = Currency::isDefault()->first();
            $user->currency_code = $currency->code;
        }

        $user->save();

        return $user;
    }

}
