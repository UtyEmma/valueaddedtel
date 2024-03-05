<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedCountry extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['currency_id', 'status'];

    function currency(){
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
