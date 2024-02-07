<?php

namespace App\Filament\Resources\ShopResource\Pages;

use App\Filament\Resources\ShopResource;
use Filament\Resources\Pages\CreateRecord;

class CreateShop extends CreateRecord
{
    protected static string $resource = ShopResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.dashboard.resources.shops.index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Shop\Shop Created';
    }
}
