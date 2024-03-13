<?php

namespace App\Filament\Resources\Services\ServiceProductResource\Pages;

use App\Filament\Resources\Services\ServiceProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceProduct extends ViewRecord
{
    protected static string $resource = ServiceProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
