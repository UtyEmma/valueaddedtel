<?php

namespace App\Filament\Resources\AccountTierResource\Pages;

use App\Filament\Resources\AccountTierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccountTier extends EditRecord
{
    protected static string $resource = AccountTierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
