<?php

namespace App\Rules;

use App\Models\ConfirmationCode;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $confirmationCode = ConfirmationCode::where('code', $value)->first();

        if(!$confirmationCode) {
            $fail('The :attribute does not exist');
        };

        if($confirmationCode->is_expired) {
            $fail('The :attribute has expired');
        };

        if($confirmationCode->is_used) {
            $fail('This :attribute has already been used');
        }

    }
}
