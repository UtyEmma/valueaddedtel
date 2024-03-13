<?php

namespace App\Filament\Resources\Services\ServiceProductItemsResource\Pages;

use App\Filament\Resources\Services\ServiceProductItemsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceProductItems extends ViewRecord
{
    protected static string $resource = ServiceProductItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
