<?php

namespace App\Filament\Widgets;

use App\Models\Vehicle;
use Closure;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ExpiredCarRegistration extends BaseWidget
{
    protected static ?int $sort = 2;

//    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Vehicle::query()->whereRaw('registration_date <= (CURRENT_DATE + INTERVAL remind_before DAY)');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('make_model'),
            TextColumn::make('registration_date'),
        ];
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-m-truck';
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Action::make('List')
                ->label('Vehicles List')
                ->url(route('filament.dashboard.resources.vehicles.index'))
                ->icon('heroicon-o-plus')
                ->button(),
            Action::make('create')
                ->url(route('filament.dashboard.resources.vehicles.create'))
                ->icon('heroicon-o-plus')
                ->button(),
        ];
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn(Vehicle $record): string => route('filament.dashboard.resources.vehicles.edit',
            ['record' => $record]);
    }

    protected function getTablePollingInterval(): ?string
    {
        return '10s';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No expired car registration';
    }
}
