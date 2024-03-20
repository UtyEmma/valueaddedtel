<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'country_code', 'code', 'rate', 'is_default', 'symbol'];

    protected $primary_key = 'code';
    public $incrementing = false;

    function scopeIsDefault($query){
        $query->where('is_default', true);
    }

    function country(){
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

    function convert($amount, $targetCurrency = null) {
        $targetCurrency = $targetCurrency ?? session('currency');

        if(!$targetCurrency = Currency::find($targetCurrency->id)){
            toast('There was a problem! Please contact support for assistance', 'Currency Formatting Error')
                ->error();
            abort(400);
        }

        $exchangeRate = $this->rate;
        $baseRate = $amount / $exchangeRate;
        $targetRate = $targetCurrency->rate;
        return number_format($baseRate * $targetRate, 2, '.', '');
    }


}
