<?php

namespace App\Filament\Widgets;

use App\Models\Service;
use Closure;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ExpiredVehicleService extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getTableQuery(): Builder
    {
        return Service::with([
            'vehicle', 'part' => function ($query) {
                $query->withoutGlobalScopes();
//                $query->withoutGlobalScopes()
//                    ->where('active_alert', 1);
            }
        ])
            ->where('services.followup_date', '<=', now())
            ->orWhereColumn('current_mileage', '>=', 'followup_mileage');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('vehicle.make_model'),
            TextColumn::make('part.name')->label('Part\Action'),
            TextColumn::make('followup_mileage'),
            TextColumn::make('followup_date'),
        ];
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-wrench-screwdriver';
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Action::make('Vehicles List')
                ->url(route('filament.dashboard.resources.vehicles.index'))
                ->icon('heroicon-o-plus')
                ->button(),
            Action::make('Services List')
                ->url(route('filament.dashboard.resources.services.index'))
                ->icon('heroicon-o-plus')
                ->button(),
        ];
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn(Service $record): string => route('filament.dashboard.resources.services.edit',
            ['record' => $record]);
    }

    protected function getTablePollingInterval(): ?string
    {
        return '10s';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No service due';
    }
}
