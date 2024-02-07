<?php

namespace App\Filament\Resources\DrivingLicenseResource\Pages;

use App\Filament\Resources\DrivingLicenseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDrivingLicense extends CreateRecord
{
    protected static string $resource = DrivingLicenseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Driving License Created';
    }
}
