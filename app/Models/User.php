<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Roles;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = ['firstname', 'lastname', 'username', 'email', 'password', 'phone', 'avatar', 'country_id', 'referrer_id', 'status', 'currency_id'];

    protected $hidden = ['password', 'pin', 'referrer_id', 'country_id', 'tier_id', 'package_id', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'pin' => 'hashed',
        'status' => Roles::USER
    ];

    static function booted() {

    }

    function country(){
        return $this->belongsTo(Country::class);
    }

    function wallet(){
        return $this->hasOne(Wallet::class);
    }

    function currency(){
        return $this->belongsTo(Currency::class);
    }

    function referrer(){
        return $this->belongsTo(User::class, 'referrer_id');
    }

    function referrals(){
        return $this->hasMany(User::class, 'referrer_id');
    }

    function tier(){
        return $this->hasOne(AccountTier::class, 'tier_id');
    }

    function package(){
        return $this->hasOne(Package::class, 'package_id');
    }

    function packageHistory(){
        return $this->hasMany(PackageHistory::class, 'user_id');
    }

    function kycVerifications(){
        return $this->hasMany(KYCVerification::class, 'user_id');
    }

    function confirmationCodes(){
        return $this->hasMany(ConfirmationCode::class, 'user_id');
    }

    function getIsAdminAttribute(){
        return ($this->role == Roles::ADMIN) || ($this->role == Roles::SUPERADMIN);
    }

    function getIsSuperAdminAttribute(){
        return $this->role == Roles::SUPERADMIN;
    }

    public function canAccessPanel(Panel $panel): bool {
        return $this->is_admin;
    }

    function getFilamentName(): string {
        return implode(' ', [$this->firstname, $this->lastname]);
    }


}
