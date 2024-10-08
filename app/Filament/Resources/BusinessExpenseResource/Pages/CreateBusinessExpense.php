<?php

namespace App\Filament\Resources\BusinessExpenseResource\Pages;

use App\Filament\Resources\BusinessExpenseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessExpense extends CreateRecord
{
    protected static string $resource = BusinessExpenseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Business Expense Created';
    }
}
