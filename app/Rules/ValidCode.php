<?php

namespace App\Rules;

use App\Enums\ConfirmationActions;
use App\Models\ConfirmationCode;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCode implements ValidationRule {

    public function __construct(
        private ConfirmationActions | null $action = null
    ) {

    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $confirmation = ConfirmationCode::where('code', $value);

        if($this->action){
            $confirmation->where('action', $this->action);
        }

        if($user = authenticated()){
            $confirmation->where('user_id', $user->id);
        }

        $confirmationCode = $confirmation->first();

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
