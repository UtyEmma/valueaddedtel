<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'flag', 'iso_code', 'is_default'];

    function currency(){
        return $this->hasOne(Currency::class, 'country_id');
    }

    function users(){
        return $this->hasMany(User::class, 'country_id');
    }

}