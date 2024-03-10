<?php

namespace App\Filament\Resources\AccountTierResource\Pages;

use App\Filament\Resources\AccountTierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccountTiers extends ListRecords
{
    protected static string $resource = AccountTierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
