<?php

namespace App\Filament\Resources\SupportedCountryResource\Pages;

use App\Filament\Resources\SupportedCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupportedCountry extends EditRecord
{
    protected static string $resource = SupportedCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
