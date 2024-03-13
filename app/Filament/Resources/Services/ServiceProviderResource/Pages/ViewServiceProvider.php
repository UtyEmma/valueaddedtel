<?php

namespace App\Filament\Resources\Services\ServiceProviderResource\Pages;

use App\Filament\Resources\Services\ServiceProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceProvider extends ViewRecord
{
    protected static string $resource = ServiceProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
