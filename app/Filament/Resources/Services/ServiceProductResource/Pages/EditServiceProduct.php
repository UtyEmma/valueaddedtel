<?php

namespace App\Filament\Resources\Services\ServiceProductResource\Pages;

use App\Filament\Resources\Services\ServiceProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceProduct extends EditRecord
{
    protected static string $resource = ServiceProductResource::class;

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
