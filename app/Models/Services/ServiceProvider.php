<?php

namespace App\Models\Services;

use App\Enums\Services;
use App\Models\Countries\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model {
    use HasFactory, HasStatus;

    protected $fillable = ['name', 'shortcode', 'mode', 'meta'];

    protected $casts = [
        'meta' => 'array'
    ];

    protected $primaryKey = 'shortcode';
    public $incrementing = false;
    public $keyType = 'string';

    protected $with = ['providerCountries'];

    function scopeWhereName($query, $name){
        return $query->where('shortcode', $name);
    }

    function countries(){
        return $this->hasManyThrough(Country::class, CountryServiceProvider::class, 'provider_code', 'iso_code', 'shortcode', 'country_code');
    }

    function providerCountries(){
        return $this->hasMany(CountryServiceProvider::class, 'provider_code', 'shortcode');
    }


}
