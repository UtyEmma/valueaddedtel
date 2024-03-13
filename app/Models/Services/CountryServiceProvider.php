<?php

namespace App\Models\Services;

use App\Models\Countries\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryServiceProvider extends Model {
    use HasFactory, HasStatus;

    protected $fillable = ['country_code', 'provider_code'];

    function country() {
        return $this->belongsTo(Country::class, 'country_code');
    }

    function provider(){
        return $this->belongsTo(ServiceProvider::class, 'provider_code');
    }
}
