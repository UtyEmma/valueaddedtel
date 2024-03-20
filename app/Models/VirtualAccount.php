<?php

namespace App\Models;

use App\Models\Countries\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualAccount extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['account_name', 'bank', 'account_no', 'country_code', 'user_id', 'meta', 'status'];

    protected $casts = [
        'meta' => 'array'
    ];

    protected $attribute = [
        'meta' => []
    ];

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function country(){
        return $this->belongsTo(Country::class, 'country_code');
    }
}
