<?php

namespace App\Rules;

use App\Enums\Status;
use App\Models\Services\Service;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidProduct implements ValidationRule {

    function __construct(
        private Service $service,
        private User | null $user = null
    ){
        $this->user = $user ?? authenticated();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if(!$product = $this->service->products()->whereShortcode($value)->first()) {
            $fail("The :attribute does not exist for this service.");
            return;
        }

        // Check if the country is active
        if($product->status == Status::INACTIVE) {
            $fail("The :attribute is not available at the moment");
            return;
        }

        if($product->country_code !== $this->user->country_code) {
            $fail("The :attribute is not available in your country at the moment");
            return;
        }

    }
}
