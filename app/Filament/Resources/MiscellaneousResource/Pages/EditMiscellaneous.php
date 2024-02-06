<?php

namespace App\Filament\Resources\MiscellaneousResource\Pages;

use App\Filament\Resources\MiscellaneousResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMiscellaneous extends EditRecord
{
    protected static string $resource = MiscellaneousResource::class;

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
