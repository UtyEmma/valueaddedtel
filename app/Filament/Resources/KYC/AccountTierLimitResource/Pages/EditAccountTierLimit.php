<?php

namespace App\Filament\Resources\KYC\AccountTierLimitResource\Pages;

use App\Filament\Resources\KYC\AccountTierLimitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccountTierLimit extends EditRecord
{
    protected static string $resource = AccountTierLimitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
