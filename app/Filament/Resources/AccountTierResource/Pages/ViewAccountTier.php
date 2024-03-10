<?php

namespace App\Filament\Resources\AccountTierResource\Pages;

use App\Filament\Resources\AccountTierResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAccountTier extends ViewRecord
{
    protected static string $resource = AccountTierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
