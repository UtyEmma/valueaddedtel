<?php

namespace App\Models\Transactions;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VtuHistory extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['transaction_id', 'user_id', 'amount', 'service_code', 'provider_code', 'country_code', 'currency_code', 'narration', 'mode', 'data', 'status'];

    protected $casts = [
        'status' => PaymentStatus::class,
        'data' => 'array'
    ];

    protected $attributes = [
        'data' => []
    ];
}
