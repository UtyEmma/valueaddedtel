<?php

namespace App\Filament\Resources\Services\ServicePaymentMethodResource\Pages;

use App\Filament\Resources\Services\ServicePaymentMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServicePaymentMethods extends ListRecords
{
    protected static string $resource = ServicePaymentMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
