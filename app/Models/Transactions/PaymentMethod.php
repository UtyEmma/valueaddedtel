<?php

namespace App\Models\Transactions;

use App\Models\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {
    use HasFactory, HasStatus;

    protected $fillable = ['name', 'slug', 'image'];

    protected $primaryKey = 'slug';
    public $incrementing = false;

    function transactions(){
        return $this->hasMany(Transaction::class, 'payment_method_id');
    }

    function countries(){
        return $this->hasManyThrough(CountryPaymentMethod::class, Country::class, 'payment_method_id', 'country_id');
    }


}
