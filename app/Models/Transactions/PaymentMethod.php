<?php

namespace App\Models\Transactions;

use App\Models\Countries\Country;
use App\Models\Countries\CountryPaymentMethod;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {
    use HasFactory, HasStatus;

    protected $fillable = ['name', 'shortcode', 'image'];

    protected $primaryKey = 'shortcode';
    public $incrementing = false;

    function transactions(){
        return $this->hasMany(Transaction::class, 'payment_method_code');
    }

    function countries(){
        return $this->hasManyThrough(CountryPaymentMethod::class, Country::class, 'payment_method_code', 'country_code');
    }

    function paymentMethodCountries(){
        return $this->hasMany(CountryPaymentMethod::class, 'payment_method_code', 'shortcode');
    }


}
