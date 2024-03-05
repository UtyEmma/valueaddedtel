<?php

namespace App\Rules;

use App\Models\Country as ModelsCountry;
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
        if(!$country = ModelsCountry::find($value)){
            $fail('The selected :attribute is invalid');
        }

        if (!ModelsCountry::where("iso_code", $value)->whereHas('supported')->exists()) {
            $fail('The selected :attribute is not supported');
        }
    }
}
