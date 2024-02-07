<?php

namespace App\Filament\Resources\PartResource\Pages;

use App\Filament\Resources\PartResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePart extends CreateRecord
{
    protected static string $resource = PartResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.dashboard.resources.parts.index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Part Created';
    }
}
