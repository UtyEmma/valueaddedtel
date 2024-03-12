<?php

namespace App\Models\Services;

use App\Models\Country;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryService extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['service_code', 'country_code', 'status'];

    function service(){
        return $this->belongsTo(Service::class, 'service_code');
    }
    function country(){
        return $this->belongsTo(Country::class, 'country_code');
    }

    function provider() {
        return $this->belongsTo(ServiceProvider::class, 'provider_code');
    }
}
