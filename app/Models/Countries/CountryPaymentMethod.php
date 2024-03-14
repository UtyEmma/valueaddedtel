<?php

namespace App\Models\Countries;

use App\Models\Transactions\PaymentMethod;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryPaymentMethod extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['country_code', 'payment_method_code'];

    function country(){
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

    function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class, 'payment_method_code', 'shortcode');
    }
}
