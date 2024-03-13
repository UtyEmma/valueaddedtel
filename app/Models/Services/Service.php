<?php

namespace App\Models\Services;

use App\Models\Countries\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model {
    use HasFactory, HasStatus, SoftDeletes;

    protected $fillable = ['name', 'shortcode'];

    protected $primary = 'shortcode';
    public $incrementing = false;

    protected $with = ['products'];

    function products(){
        return $this->hasMany(ServiceProduct::class, 'service_code', 'shortcode');
    }

    function countries(){
        return $this->hasManyThrough(Country::class, CountryService::class, 'service_code', 'iso_code', 'shortcode', 'country_code');
    }

    function serviceCountries(){
        return $this->hasMany(CountryService::class, 'service_code', 'shortcode');
    }

}
