<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageHistory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['package_id', 'user_id', 'fee', 'currency_code'];

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function package(){
        return $this->belongsTo(Package::class, 'package_id');
    }

    function currency(){
        return $this->belongsTo(Currency::class, 'currency_code');
    }

}
