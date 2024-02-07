<?php

namespace App\Filament\Resources\MiscellaneousResource\Pages;

use App\Filament\Resources\MiscellaneousResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMiscellaneous extends CreateRecord
{
    protected static string $resource = MiscellaneousResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
