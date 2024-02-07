<?php

namespace App\Filament\Resources\DrivingLicenseResource\Pages;

use App\Filament\Resources\DrivingLicenseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDrivingLicenses extends ListRecords
{
    protected static string $resource = DrivingLicenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
