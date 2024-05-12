<?php

namespace App\Filament\Resources\BusinessCompanyResource\Pages;

use App\Filament\Resources\BusinessCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessCompanies extends ListRecords
{
    protected static string $resource = BusinessCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
