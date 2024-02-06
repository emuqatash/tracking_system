<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use App\Models\Service;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->withoutTrashed())
                ->badge(Service::query()->withoutTrashed()
                    ->count()),
            'Require Followup' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query
                    ->withoutTrashed()
                    ->where('followup_mileage', '!=', null)
                    ->orWhere('followup_date', '!=', null))
                ->badge(Service::query()
                    ->withoutTrashed()
                    ->where('followup_mileage', '!=', null)
                    ->orWhere('followup_date', '!=', null)
                    ->count())
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
