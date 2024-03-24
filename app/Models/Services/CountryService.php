<?php

namespace App\Models\Services;

use App\Enums\Services;
use App\Models\Countries\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryService extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['service_code', 'country_code', 'values'];

    protected $attributes = [
        'values' => []
    ];

    protected $casts = [
        'service_code' => Services::class,
        'values' => 'array'
    ];

    function service(){
        return $this->belongsTo(Service::class, 'service_code', 'shortcode');
    }

    function country(){
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

    function getProductsAttribute(){
        return $this->service->products()->where('country_code', $this->country_code)->get();
    }

    // function provider(){
    //     return $this->belongsTo(ServiceProvider::class, 'provider_code');
    // }

}
