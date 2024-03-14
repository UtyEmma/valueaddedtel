<?php

namespace App\Filament\Resources\Payments\PaymentMethodResource\Pages;

use App\Filament\Resources\Payments\PaymentMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentMethod extends CreateRecord
{
    protected static string $resource = PaymentMethodResource::class;
}
