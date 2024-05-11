<?php

namespace App\Filament\Resources\BusinessExpenseResource\Pages;

use App\Filament\Resources\BusinessExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessExpense extends CreateRecord
{
    protected static string $resource = BusinessExpenseResource::class;
}
