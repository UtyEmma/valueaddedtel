<?php

namespace App\Models\Transactions;

use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Enums\TransactionType;
use App\Models\Countries\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['reference', 'payment_method_code', 'user_id', 'narration', 'amount', 'transactable_id', 'transactable_type', 'type', 'flow', 'currency_code', 'status'];

    protected $casts = [
        'status' => PaymentStatus::class,
        'payment_method_code' => PaymentMethods::class,
        'flow' => TransactionType::class
    ];

    // protected $with = ['paymentMethod', 'user'];

    protected function amount(): Attribute {
        $targetCurrency = session('currency');
        return Attribute::make(
            get: fn (string $value) => $this->currency->convert($value, $targetCurrency)
        );
    }

    function transactable(){
        return $this->morphTo();
    }

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function currency(){
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }

    function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class, 'payment_method_code', 'shortcode');
    }


}
