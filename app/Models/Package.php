<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'amount', 'bonus', 'comission', 'point_value', 'status', 'is_default'];

    function scopeIsDefault($query){
        $query->where('is_default', true);
    }

    function users(){
        return $this->hasMany(User::class, 'package_id');
    }

}
