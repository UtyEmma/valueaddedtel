<?php

namespace App\Models\Countries;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, HasUuids;

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

    function currency(){
        return $this->hasOne(Currency::class, 'country_code', 'iso_code');
    }

    function supported(){
        return $this->hasOne(SupportedCountry::class, 'country_code', 'iso_code');
    }

    function users(){
        return $this->hasMany(User::class, 'country_id');
    }

}
