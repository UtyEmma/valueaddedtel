<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Roles;
use App\Traits\HasStatus;
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
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasStatus;

    protected $fillable = ['firstname', 'lastname', 'username', 'email', 'password', 'phone', 'avatar', 'country_id', 'referrer_id', 'currency_id'];

    protected $hidden = ['password', 'pin', 'referrer_id', 'country_id', 'tier_id', 'package_id', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'pin' => 'hashed',
        'status' => Roles::USER
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
        return ($this->role == Roles::ADMIN->value) || ($this->role == Roles::SUPERADMIN->value);
    }

    function getIsSuperAdminAttribute(){
        return $this->role == Roles::SUPERADMIN->value;
    }

    public function canAccessPanel(Panel $panel): bool {
        return $this->is_admin;
    }

    public function getFilamentName(): string{
        return "{$this->firstname} {$this->lastname}";
    }

}
