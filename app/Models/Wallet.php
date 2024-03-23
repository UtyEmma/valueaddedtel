<?php

namespace App\Models;

use App\Models\Countries\Currency;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'main_bal', 'currency_code', 'cashback_bal', 'bonus_bal', 'accumulated_pv', 'total_pv'];

    protected function mainBal(): Attribute {
        $targetCurrency = $this->user->currency;
        return Attribute::make(
            get: fn (string $value) => $this->currency->convert($value, $targetCurrency)
        );
    }

    protected function cashbackBal(): Attribute {
        $targetCurrency = $this->user->currency;
        return Attribute::make(
            get: fn (string $value) => $this->currency->convert($value, $targetCurrency)
        );
    }

    protected function bonusBal(): Attribute {
        $targetCurrency = $this->user->currency;
        return Attribute::make(
            get: fn (string $value) => $this->currency->convert($value, $targetCurrency)
        );
    }

    protected $attributes = [
        'main_bal' => 0,
        'cashback_bal' => 0,
        'bonus_bal' => 0,
        'accumulated_pv' => 0,
        'total_pv' => 0,
    ];

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function currency(){
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }

}
