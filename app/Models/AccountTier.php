<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTier extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'level', 'max_balance', 'max_deposit', 'max_withdrawal', 'is_default'];

    protected $primary_key = 'level';

    function scopeIsDefault($query){
        $query->where('is_default', true);
    }

    function users(){
        return $this->hasMany(User::class, 'tier_id');
    }

}
