<?php

namespace App\Models\Services;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProductItem extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['service_product_code', 'name', 'meta', 'shortcode', 'amount'];

    function product(){
        return $this->belongsTo(ServiceProduct::class, 'service_product_code');
    }
}
