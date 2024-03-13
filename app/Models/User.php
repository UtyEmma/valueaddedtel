<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Roles;
use App\Enums\Status;
use App\Models\ConfirmationCode;
use App\Models\Countries\Country;
use App\Models\Countries\Currency;
use App\Models\KYC\AccountTier;
use App\Models\KYC\KYCVerification;
use App\Models\Packages\Package;
use App\Models\Packages\PackageHistory;
use App\Traits\HasStatus;
use App\Traits\VerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName, MustVerifyEmail {
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasStatus, VerifyEmail;

    protected $fillable = ['firstname', 'lastname', 'username', 'email', 'password', 'phone', 'avatar', 'country_code', 'currency_code', 'referrer_id'];

    protected $hidden = ['password', 'pin', 'referrer_id', 'country_code', 'currency_code', 'tier_id', 'package_id', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'pin' => 'hashed',
        'status' => Status::class,
        'role' => Roles::class,
    ];

    protected $attributes = [
        'role' => Roles::USER,
        'status' => Status::ACTIVE,
    ];

    function scopeAdmin(Builder $query){
        $query->where('role', Roles::ADMIN)->orWhere('role', Roles::SUPERADMIN);
    }

    function scopeSuperAdmin(Builder $query){
        $query->where('role', Roles::SUPERADMIN);
    }

    function scopeUser(Builder $query){
        $query->where('role', Roles::USER);
    }

    function country(){
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

    function wallet(){
        return $this->hasOne(Wallet::class);
    }

    function currency(){
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }

    function referrer(){
        return $this->belongsTo(User::class, 'referrer_id');
    }

    function referrals(){
        return $this->hasMany(User::class, 'referrer_id');
    }

    function tier(){
        return $this->belongsTo(AccountTier::class, 'tier_id');
    }

    function package(){
        return $this->belongsTo(Package::class, 'package_id');
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

    public function getFilamentName(): string{
        return "{$this->firstname} {$this->lastname}";
    }

}
