<?php

namespace App\Filament\Resources\Services\ServiceProviderResource\Pages;

use App\Filament\Resources\Services\ServiceProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceProvider extends EditRecord
{
    protected static string $resource = ServiceProviderResource::class;

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
