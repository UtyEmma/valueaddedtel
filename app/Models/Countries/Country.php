<?php

namespace App\Models\Countries;

use App\Models\Services\CountryService;
use App\Models\Services\Service;
use App\Models\User;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['name', 'flag', 'iso_code', 'intl_phone', 'is_default'];

    protected $primary_key = 'iso_code';
    public $incrementing = false;

    protected $attributes = [
        'is_default' => true
    ];

    function scopeIsDefault($query){
        $query->where('is_default', true);
    }

    function scopeIsSupported($query){
        $query->has('supported');
    }

    function scopeDoesntHaveService($query, $shortcode) {
        $query->doesntHave('services', 'shortcode', $shortcode);
    }

    function currency(){
        return $this->hasOne(Currency::class, 'country_code', 'iso_code');
    }

    function supported(){
        return $this->hasOne(SupportedCountry::class, 'country_code', 'iso_code');
    }

    function services(){
        return $this->hasManyThrough(Service::class, CountryService::class, 'country_code', 'shortcode', 'iso_code', 'service_code');
    }


    function users(){
        return $this->hasMany(User::class, 'country_id');
    }

}
