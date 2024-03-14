<?php

namespace App\Models\Services;

use App\Enums\Services;
use App\Enums\Status;
use App\Models\Countries\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class ServiceProduct extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['name', 'shortcode', 'service_code', 'provider_code', 'country_code', 'cashback', 'cashback_type', 'meta', 'amount', 'image'];

    protected $casts = [
        'meta' => 'array',
        'status' => Status::class,
        'service_code' => Services::class
    ];

    protected $attributes = [
        'status' => Status::ACTIVE
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('active', function ($builder) {
            $builder->whereNot('status', Status::INACTIVE);
        });
    }
    function items(){
        return $this->hasMany(ServiceProductItem::class, 'service_product_code', 'shortcode');
    }

    function service(){
        return $this->belongsTo(Service::class, 'service_code', 'shortcode');
    }

    function provider(){
        return $this->belongsTo(ServiceProvider::class, 'provider_code');
    }

    function country(){
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

}
