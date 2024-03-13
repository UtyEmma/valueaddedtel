<?php

namespace App\Models\Countries;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedCountry extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['country_code'];

    function country(){
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }
}
