<?php

namespace App\Models\Packages;

use App\Models\Account\User;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model{
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['name', 'fee', 'bonus', 'max_level', 'point_value', 'is_default'];

    function scopeIsDefault($query){
        $query->where('is_default', true);
    }

    function users(){
        return $this->hasMany(User::class, 'package_id');
    }

}
