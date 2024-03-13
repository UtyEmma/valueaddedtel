<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProductItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['service_product_id', 'name', 'shortcode', 'amount'];
}
