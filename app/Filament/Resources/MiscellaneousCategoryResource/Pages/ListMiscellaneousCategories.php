<?php

namespace App\Filament\Resources\MiscellaneousCategoryResource\Pages;

use App\Filament\Resources\MiscellaneousCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMiscellaneousCategories extends ListRecords
{
    protected static string $resource = MiscellaneousCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
