<?php

namespace App\Filament\Resources\NoResource\Pages;

use App\Filament\Resources\NoResource;
use Filament\Resources\Pages\Page;

class EditProfile extends Page
{
    protected static string $resource = NoResource::class;

    protected static string $view = 'filament.resources.no-resource.pages.edit-profile';
}
