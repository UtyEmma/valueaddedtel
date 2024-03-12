<?php

namespace App\Models\Transactions;

use App\Models\Country;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryPaymentMethod extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['country_id', 'payment_method_id'];

    function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
