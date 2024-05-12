<?php

namespace App\Filament\Resources\BusinessExpenseCategoryResource\Pages;

use App\Filament\Resources\BusinessExpenseCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessExpenseCategory extends CreateRecord
{
    protected static string $resource = BusinessExpenseCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Business Expense Category Created';
    }
}
