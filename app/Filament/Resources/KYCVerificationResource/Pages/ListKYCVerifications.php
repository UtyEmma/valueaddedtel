<?php

namespace App\Filament\Resources\KYCVerificationResource\Pages;

use App\Filament\Resources\KYCVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKYCVerifications extends ListRecords
{
    protected static string $resource = KYCVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
