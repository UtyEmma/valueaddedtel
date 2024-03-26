<?php

namespace App\Models\Packages;

use App\Models\User;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model{
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['name', 'fee', 'bonus', 'max_level', 'point_value', 'is_default', 'cashback'];

    function scopeIsDefault($query){
        $query->where('is_default', true);
    }

    function users(){
        return $this->hasMany(User::class, 'package_id');
    }

    function getIsFreeAttribute(){
        return $this->fee <= 0;
    }

    function getIsNotFreeAttribute(){
        return $this->fee > 0;
    }

    function getCanEarnCashbackAttribute(){
        return $this->cashback;
    }

    function getIsHighestAttribute(){
        return $this->where('fee', '>=', $this->fee)->whereNot('id', $this->id)->doesntExist();
    }

    function currentPackageDiff(User $user = null){
        $user = $user ?? authenticated();
        return $this->fee - $user->package->fee;
    }

}
