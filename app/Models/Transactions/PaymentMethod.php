<?php

namespace App\Models\Transactions;

use App\Enums\PaymentMethods;
use App\Models\Countries\Country;
use App\Models\Countries\CountryPaymentMethod;
use App\Models\Services\Service;
use App\Models\Services\ServicePaymentMethod;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {
    use HasFactory, HasStatus;

    protected $fillable = ['name', 'shortcode', 'image', 'mode', 'meta', 'isOnline'];

    protected $casts = [
        'shortcode' => PaymentMethods::class,
        'meta' => 'array'
    ];

    function scopeWhereName($query, $name){
        return $query->where('shortcode', $name);
    }

    function transactions(){
        return $this->hasMany(Transaction::class, 'payment_method_code');
    }

    function countries(){
        return $this->hasManyThrough(Country::class, CountryPaymentMethod::class, 'payment_method_code', 'iso_code', 'shortcode', 'country_code');
    }

    function paymentMethodCountries(){
        return $this->hasMany(CountryPaymentMethod::class, 'payment_method_code', 'shortcode');
    }

    function paymentMethodServices(){
        return $this->hasMany(ServicePaymentMethod::class, 'payment_method_code', 'shortcode');
    }

    function services(){
        return $this->hasManyThrough(Service::class, ServicePaymentMethod::class, 'payment_method_code', 'shortcode', 'shortcode', 'service_code');
    }

    function getImageFileAttribute(){
        return asset('storage/'.$this->image);
    }

    function getIsTestModeAttribute(){
        return $this->mode == 'test';
    }

    function getIsLiveModeAttribute(){
        return $this->mode == 'live';
    }


}
