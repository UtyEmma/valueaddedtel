<?php

namespace App\Models\KYC;

use App\Models\Account\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KYCVerification extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'tier_id', 'data', 'status'];

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function tier(){
        return $this->belongsTo(AccountTier::class, 'tier_id');
    }

}
