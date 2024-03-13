<?php

namespace App\Filament\Resources\Services\ServiceProviderResource\Pages;

use App\Filament\Resources\Services\ServiceProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceProvider extends CreateRecord
{
    protected static string $resource = ServiceProviderResource::class;
}
