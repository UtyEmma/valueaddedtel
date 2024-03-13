<?php

namespace App\Models\Services;

use App\Models\Countries\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryService extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['service_code', 'country_code'];

    function service(){
        return $this->belongsTo(Service::class, 'service_code');
    }
    function country(){
        return $this->belongsTo(Country::class, 'country_code');
    }

    // function provider(){
    //     return $this->belongsTo(ServiceProvider::class, 'provider_code');
    // }

}
