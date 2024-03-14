<?php

namespace App\Models\Services;

use App\Enums\PaymentMethods;
use App\Enums\Services;
use App\Models\Countries\Country;
use App\Models\Transactions\PaymentMethod;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePaymentMethod extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['country_code', 'payment_method_code', 'service_code'];

    protected $casts = [
        // 'service_code' => Services::class,
        // 'payment_method_code' => PaymentMethods::class
    ];

    function country(){
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

    function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class, 'payment_method_code', 'shortcode');
    }

    function service(){
        return $this->belongsTo(Service::class, 'service_code', 'shortcode');
    }
}
