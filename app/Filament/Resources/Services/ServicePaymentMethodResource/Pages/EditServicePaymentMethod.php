<?php

namespace App\Filament\Resources\Services\ServicePaymentMethodResource\Pages;

use App\Filament\Resources\Services\ServicePaymentMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServicePaymentMethod extends EditRecord
{
    protected static string $resource = ServicePaymentMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
