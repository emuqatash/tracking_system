<?php

namespace App\Filament\Resources\BusinessExpenseCategoryResource\Pages;

use App\Filament\Resources\BusinessExpenseCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessExpenseCategory extends EditRecord
{
    protected static string $resource = BusinessExpenseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
