<?php

namespace App\Filament\Resources\BusinessCompanyResource\Pages;

use App\Filament\Resources\BusinessCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessCompany extends EditRecord
{
    protected static string $resource = BusinessCompanyResource::class;

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
