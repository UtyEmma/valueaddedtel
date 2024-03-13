<?php

namespace App\Filament\Resources\Services\CountryServiceResource\Pages;

use App\Filament\Resources\Services\CountryServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCountryServices extends ListRecords
{
    protected static string $resource = CountryServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
