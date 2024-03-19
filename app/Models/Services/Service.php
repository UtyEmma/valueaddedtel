<?php

namespace App\Models\Services;

use App\Enums\Services;
use App\Models\Countries\Country;
use App\Models\Transactions\PaymentMethod;
use App\Models\User;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model {
    use HasFactory, HasStatus, SoftDeletes;

    protected $fillable = ['name', 'shortcode'];

    protected $casts = [
        'shortcode' => Services::class
    ];

    protected $with = ['products'];

    function products(){
        return $this->hasMany(ServiceProduct::class, 'service_code', 'shortcode');
    }

    function countries(){
        return $this->hasManyThrough(Country::class, CountryService::class, 'service_code', 'iso_code', 'shortcode', 'country_code');
    }

    function serviceCountries(){
        return $this->hasMany(CountryService::class, 'service_code', 'shortcode');
    }

    function servicePaymentMethods(){
        return $this->hasMany(ServicePaymentMethod::class, 'service_code', 'shortcode');
    }

    function paymentMethods(){
        return $this->hasManyThrough(PaymentMethod::class, ServicePaymentMethod::class, 'service_code', 'shortcode', 'shortcode', 'payment_method_code');
    }

    function methods(User $user = null){
        $user = $user ?? authenticated();
        return $this->servicePaymentMethods()->where('country_code', $user->country_code)->get();
    }

}
