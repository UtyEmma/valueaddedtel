<?php

namespace App\Rules;

use App\Enums\ConfirmationActions;
use App\Models\ConfirmationCode;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCode implements ValidationRule {

    public function __construct(
        private ConfirmationActions | null $action = null,
        private $class = ConfirmationCode::class
    ) {

    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $confirmation = $this->class::where('code', $value);

        if($this->class == ConfirmationCode::class) {
            if($this->action){
                $confirmation->where('action', $this->action);
            }
        }

        if($user = authenticated()){
            $confirmation->where('user_id', $user->id);
        }

        $confirmationCode = $confirmation->first();

        // dd($confirmationCode);

        if(!$confirmationCode) {
            $fail('The :attribute does not exist');
            return;
        };

        if($confirmationCode->is_expired) {
            $fail('The :attribute has expired');
            return;
        };

        if($confirmationCode->is_used) {
            $fail('This :attribute has already been used');
            return;
        }

    }
}
