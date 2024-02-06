<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use App\Filament\Resources\VehicleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.dashboard.resources.vehicles.index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Vehicle Created';
    }
}
