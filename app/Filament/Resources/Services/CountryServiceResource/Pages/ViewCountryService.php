<?php

namespace App\Filament\Resources\Services\CountryServiceResource\Pages;

use App\Filament\Resources\Services\CountryServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCountryService extends ViewRecord
{
    protected static string $resource = CountryServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
