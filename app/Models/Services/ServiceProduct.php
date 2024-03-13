<?php

namespace App\Models\Services;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProduct extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['name', 'shortcode', 'provider_code', 'amount'];

}
