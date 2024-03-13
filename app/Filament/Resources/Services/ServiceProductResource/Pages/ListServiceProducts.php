<?php

namespace App\Filament\Resources\Services\ServiceProductResource\Pages;

use App\Filament\Resources\Services\ServiceProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceProducts extends ListRecords
{
    protected static string $resource = ServiceProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
