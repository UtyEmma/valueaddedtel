<?php

namespace App\Rules;

use App\Models\Countries\Country as CountriesCountry;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Country implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if(!CountriesCountry::where('iso_code', $value)->first()){
            $fail('The selected :attribute is invalid');
        }

        if (!CountriesCountry::where("iso_code", $value)->has('supported')->exists()) {
            $fail('The selected :attribute is not supported');
        }
    }
}
