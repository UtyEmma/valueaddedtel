<?php

namespace App\Filament\Resources\KYCVerificationResource\Pages;

use App\Filament\Resources\KYCVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKYCVerification extends ViewRecord
{
    protected static string $resource = KYCVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
