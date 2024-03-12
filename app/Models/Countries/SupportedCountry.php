<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedCountry extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['country_id', 'status'];

    function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
}
