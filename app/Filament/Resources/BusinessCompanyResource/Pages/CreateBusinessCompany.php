<?php

namespace App\Filament\Resources\BusinessCompanyResource\Pages;

use App\Filament\Resources\BusinessCompanyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessCompany extends CreateRecord
{
    protected static string $resource = BusinessCompanyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Business Expense Created';
    }
}
