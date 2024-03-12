<?php

namespace App\Services;

use App\Models\Account\User;
use App\Models\Countries\Country;
use App\Models\Countries\Currency;

class CountryService {

    function setCountry(User $user, $code) {
        if(!$country = Country::where('iso_code', $code)->first()) return false;
        $user->country_id = $country->iso_code;
        $user->save();
        return $user;
    }

    function setCurrency(User $user, $code = null){
        if($currency = Currency::where('code', $code)->first()) {
            $user->currency_id = $currency->code;
        }else{
            $currency = Currency::isDefault()->first();
            $user->currency_id = $currency->code;
        }

        $user->save();

        return $user;
    }

}
