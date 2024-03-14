<?php

namespace App\Rules;

use App\Models\Transactions\PaymentMethod;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPaymentMethod implements ValidationRule {

    public function __construct(
        private $country = null,
        private $service = null
    ) {

    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if(!$paymentMethod = PaymentMethod::where('shortcode', $value)->isActive()->first()) {
            $fail('The :attribute is not valid');
            return;
        }

        $user = authenticated();

        if($this->country){
            if(
                !$paymentMethod
                    ->paymentMethodCountries()
                    ->whereHas(
                        'country',
                        fn($query) => $query->where('country_code', $this->country)->isActive()
                    )->isActive('country_payment_methods.status')
                    ->exists()
                ){
                $fail('The :attribute is not available in your country');
                return;
            }
        }

        if($this->service) {
            if(
                !$paymentMethod
                    ->paymentMethodServices()
                    ->isActive('service_payment_methods.status')
                    ->when($this->country, function($query){
                        $query->where('country_code', $this->country)->isActive();
                    })->whereHas('service',
                        fn($query) => $query->where('shortcode', $this->service)->isActive()
                    )->first()
            ){
                $fail('The :attribute is not available for this service');
                return;
            }
        }
    }
}
