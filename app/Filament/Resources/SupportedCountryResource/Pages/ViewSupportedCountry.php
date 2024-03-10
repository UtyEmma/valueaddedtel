<?php

namespace App\Filament\Resources\SupportedCountryResource\Pages;

use App\Filament\Resources\SupportedCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSupportedCountry extends ViewRecord
{
    protected static string $resource = SupportedCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
