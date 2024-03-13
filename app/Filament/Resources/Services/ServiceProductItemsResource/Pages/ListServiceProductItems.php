<?php

namespace App\Filament\Resources\Services\ServiceProductItemsResource\Pages;

use App\Filament\Resources\Services\ServiceProductItemsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceProductItems extends ListRecords
{
    protected static string $resource = ServiceProductItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
