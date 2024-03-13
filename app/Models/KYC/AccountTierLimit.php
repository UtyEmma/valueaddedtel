<?php

namespace App\Models\KYC;

use App\Models\Countries\Country;
use App\Models\Services\Service;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTierLimit extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['country_code', 'tier_id', 'service_code', 'daily_limit', 'lifetime_limit', 'single_limit'];

    function country(){
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

    function service(){
        return $this->belongsTo(Service::class, 'service_code', 'shortcode');
    }

    function tier(){
        return $this->belongsTo(AccountTier::class, 'tier_id');
    }
}
