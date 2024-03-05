<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = ['firstname', 'lastname', 'username', 'email', 'password', 'phone', 'avatar', 'country_id', 'referrer_id', 'status', 'currency_id'];

    protected $hidden = ['password', 'pin', 'referrer_id', 'country_id', 'tier_id', 'package_id', 'remember_token', ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'pin' => 'hashed'
    ];

    function country(){
        return $this->belongsTo(Country::class);
    }

    function currency(){
        return $this->belongsTo(Currency::class);
    }

    function referrer(){
        return $this->hasOne(User::class, 'referrer_id');
    }

    function tier(){
        return $this->hasOne(AccountTier::class, 'tier_id');
    }

    function package(){
        return $this->hasOne(Package::class, 'tier_id');
    }

}
