<?php

namespace App\Filament\Resources\DrivingLicenseResource\Pages;

use App\Filament\Resources\DrivingLicenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDrivingLicense extends EditRecord
{
    protected static string $resource = DrivingLicenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
