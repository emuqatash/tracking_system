<?php

namespace App\Filament\Resources\MiscellaneousResource\Pages;

use App\Filament\Resources\MiscellaneousResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMiscellaneouses extends ListRecords
{
    protected static string $resource = MiscellaneousResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
