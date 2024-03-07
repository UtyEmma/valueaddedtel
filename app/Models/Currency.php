<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'country_code', 'code', 'is_default', 'symbol'];

    protected $primary_key = 'code';
    public $incrementing = false;

    function scopeIsDefault($query){
        $query->where('is_default', true);
    }

    function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }


}
