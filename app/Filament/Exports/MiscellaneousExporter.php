<?php

namespace App\Filament\Exports;

use App\Models\Miscellaneous;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MiscellaneousExporter extends Exporter
{
    protected static ?string $model = Miscellaneous::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('subject'),
            ExportColumn::make('description'),
            ExportColumn::make('miscellaneous_categories_id'),
            ExportColumn::make('sub_category'),
            ExportColumn::make('followup_date'),
            ExportColumn::make('followup_before_day'),
            ExportColumn::make('purchased_from'),
            ExportColumn::make('cost'),
            ExportColumn::make('file'),
            ExportColumn::make('file_original_filename'),
            ExportColumn::make('active_alert'),
            ExportColumn::make('account_id'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your miscellaneous export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
