<?php

namespace App\Filament\Resources\Services\ServiceProductItemsResource\Pages;

use App\Filament\Resources\Services\ServiceProductItemsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceProductItems extends EditRecord
{
    protected static string $resource = ServiceProductItemsResource::class;

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
