<?php

namespace App\Models\Transactions;

use App\Enums\PaymentStatus;
use App\Enums\Services;
use App\Models\Countries\Country;
use App\Models\Countries\Currency;
use App\Models\Services\Service;
use App\Models\Services\ServiceProduct;
use App\Models\Services\ServiceProductItem;
use App\Models\Services\ServiceProvider;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['product_code', 'product_item_code', 'user_id', 'amount', 'reference', 'service_code', 'provider_code', 'country_code', 'currency_code', 'narration', 'meta', 'mode', 'status'];

    protected $casts = [
        'status' => PaymentStatus::class,
        'service_code' => Services::class,
        'meta' => 'array'
    ];

    // protected $attributes = [
    //     'meta' => [],
    //     'status' => PaymentStatus::PENDING
    // ];

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function service(){
        return $this->belongsTo(Service::class, 'service_code', 'shortcode');
    }

    function provider(){
        return $this->belongsTo(ServiceProvider::class, 'provider_code', 'shortcode');
    }

    function product(){
        return $this->belongsTo(ServiceProduct::class, 'product_code', 'shortcode');
    }

    function productItem(){
        return $this->belongsTo(ServiceProductItem::class, 'product_item_code', 'shortcode');
    }

    function country(){
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

    function currency(){
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }

    function transaction() {
        return $this->hasOne(Transaction::class, 'transactable_id', 'transaction_id');
    }

}
