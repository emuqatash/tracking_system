<?php

namespace App\Filament\Resources\BusinessExpenseCategoryResource\Pages;

use App\Filament\Resources\BusinessExpenseCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessExpenseCategories extends ListRecords
{
    protected static string $resource = BusinessExpenseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
