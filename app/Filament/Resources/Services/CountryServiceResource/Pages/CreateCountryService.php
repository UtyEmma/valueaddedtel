<?php

namespace App\Filament\Resources\Services\CountryServiceResource\Pages;

use App\Filament\Resources\Services\CountryServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCountryService extends CreateRecord
{
    protected static string $resource = CountryServiceResource::class;
}
