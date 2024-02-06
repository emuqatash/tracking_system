<?php

namespace App\Filament\Widgets;

use App\Models\DrivingLicense;
use Closure;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ExpiredDrivingLicense extends BaseWidget
{
    protected static ?int $sort = 2;

//    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return DrivingLicense::query()->where('expiry_date', '<=', now()->addDays(90));
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('full_name')->label('Name'),
            TextColumn::make('expiry_date'),
            TextColumn::make('remarks')->label('Country'),
        ];
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-clipboard-document';
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Action::make('List')
                ->label('Driving License list')
                ->url(route('filament.dashboard.resources.driving-licenses.index'))
                ->icon('heroicon-o-plus')
                ->button(),
            Action::make('create')
                ->url(route('filament.dashboard.resources.driving-licenses.create'))
                ->icon('heroicon-o-plus')
                ->button(),
        ];
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn(DrivingLicense $record): string => route('filament.dashboard.resources.driving-licenses.index',
            ['record' => $record]);
    }

    protected function getTablePollingInterval(): ?string
    {
        return '10s';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No expired driving license';
    }
}
