<?php

namespace App\Filament\Resources\KYC\AccountTierLimitResource\Pages;

use App\Filament\Resources\KYC\AccountTierLimitResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAccountTierLimit extends ViewRecord
{
    protected static string $resource = AccountTierLimitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
