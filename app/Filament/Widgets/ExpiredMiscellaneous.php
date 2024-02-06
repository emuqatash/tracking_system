<?php

namespace App\Filament\Widgets;

use App\Models\Miscellaneous;
use Closure;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ExpiredMiscellaneous extends BaseWidget
{
    protected static ?int $sort = 1;

//    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Miscellaneous::query()->with(['miscellaneousCategory'])->whereRaw('followup_date <= (CURRENT_DATE + INTERVAL followup_before_day DAY)');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('miscellaneousCategory.name')->label('Category'),
            TextColumn::make('sub_category'),
            TextColumn::make('followup_date'),
            TextColumn::make('followup_before_day')->label('Remind before'),
        ];
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-briefcase';
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Action::make('List')
                ->label('Miscellaneouses List')
                ->url(route('filament.dashboard.resources.miscellaneouses.index'))
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
        return fn(Miscellaneous $record): string => route('filament.dashboard.resources.miscellaneouses.edit',
            ['record' => $record]);
    }

    protected function getTablePollingInterval(): ?string
    {
        return '10s';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'No miscellaneous';
    }
}
