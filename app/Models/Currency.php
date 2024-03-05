<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'country_id', 'code', 'is_default', 'symbol'];

    protected $primary_key = 'code';
    protected $incrementing = false;

    function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }


}
