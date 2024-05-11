<?php

namespace App\Filament\Resources\BusinessExpenseResource\Pages;

use App\Filament\Resources\BusinessExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessExpense extends EditRecord
{
    protected static string $resource = BusinessExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
