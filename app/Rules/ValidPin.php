<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class ValidPin implements ValidationRule {

    function __construct(
        private $user = null
    ) {
        $this->user = $this->user ?? authenticated();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if(!Hash::check($value, $this->user->pin)) {
            $fail('The :attribute is not valid');
            return;
        }
    }
}
