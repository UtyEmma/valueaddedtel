<?php

namespace App\Models\Services;

use App\Enums\Status;
use App\Models\Countries\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProduct extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['name', 'shortcode', 'provider_code', 'country_code', 'cashback', 'cashback_type', 'meta', 'amount'];

    protected $casts = [
        'meta' => 'array',
        'status' => Status::class
    ];

    protected $attributes = [
        'status' => Status::ACTIVE
    ];

    function items(){
        return $this->hasMany(ServiceProductItem::class, 'service_product_code', 'shortcode');
    }

    function provider(){
        return $this->belongsTo(ServiceProvider::class, 'provider_code');
    }

    function country(){
        return $this->belongsTo(Country::class, 'country_code');
    }

}
