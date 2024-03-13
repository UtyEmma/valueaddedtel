<?php

namespace Database\Seeders;

use App\Models\Countries\Country;
use App\Models\Countries\CountryPaymentMethod;
use App\Models\Transactions\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $providers = config('payments.payment_providers');
        foreach($providers as $provider){
            if(!PaymentMethod::where('shortcode', $provider['shortcode'])->exists()) {
                $countries = $provider['countries'];
                unset($provider['countries']);
                $paymentMethod = PaymentMethod::create($provider);

                foreach($countries as $country){
                    if($country = Country::isSupported()->where('iso_code', $country)->first()){
                        CountryPaymentMethod::create([
                            'country_code' => $country->iso_code,
                            'payment_method_code' => $paymentMethod->shortcode
                        ]);
                    }
                }

            }
        }
    }
}
