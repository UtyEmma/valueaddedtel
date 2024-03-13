<?php

namespace App\Filament\Resources\Services\CountryServiceResource\Pages;

use App\Filament\Resources\Services\CountryServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCountryService extends EditRecord
{
    protected static string $resource = CountryServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
