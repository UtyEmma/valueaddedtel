<?php

namespace App\Filament\Resources\Services\ServicePaymentMethodResource\Pages;

use App\Filament\Resources\Services\ServicePaymentMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServicePaymentMethod extends ViewRecord
{
    protected static string $resource = ServicePaymentMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
