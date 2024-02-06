<?php

namespace App\Filament\Resources\MiscellaneousCategoryResource\Pages;

use App\Filament\Resources\MiscellaneousCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMiscellaneousCategory extends CreateRecord
{
    protected static string $resource = MiscellaneousCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
