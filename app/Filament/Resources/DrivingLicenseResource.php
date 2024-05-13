<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DrivingLicenseResource\Pages;
use App\Filament\Resources\DrivingLicenseResource\RelationManagers;
use App\Models\Country;
use App\Models\DrivingLicense;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class DrivingLicenseResource extends Resource
{
    protected static ?string $model = DrivingLicense::class;
    protected static ?string $navigationGroup = "Vehicle Care";
    protected static ?string $navigationLabel = "Driving License";
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

//****** Global Search*********/
    public static function getGloballySearchableAttributes(): array
    {
        return ['full_name', 'dl_number', 'country'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Driver' => $record->full_name,
            'DL expiry date' => $record->expiry_date,
            'Country' => $record->country,
        ];
    }

    //****** Global Search*********/

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->required(),
                Forms\Components\TextInput::make('dl_number')
                    ->label('Driving License No.')
                    ->required(),
                Forms\Components\DatePicker::make('expiry_date')
                    ->label('Driving License Expiry Date')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->required(),
                Forms\Components\TextInput::make('remind_before')
                    ->helperText('number of days')
                    ->default(0)
                    ->integer()
                    ->maxLength('4')
                    ->required(),
                Forms\Components\Select::make('country')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->default('United States')
                    ->options(Country::pluck('name', 'name')),
                Toggle::make('active_alert')
                    ->label('Activate Alert')
                    ->inline(false)
                    ->onColor('success')
                    ->offColor('gray')
                    ->default('gray'),
                Forms\Components\MarkdownEditor::make('remarks')
                    ->columnSpanFull(),

                Forms\Components\Section::make('View attachment')
                    ->schema([
                        Forms\Components\FileUpload::make('attachments')
                            ->multiple()
                            ->directory('dl-attachments')
                            ->storeFileNamesIn('attachment_file_names')
                            ->preserveFilenames()
                            ->reorderable()
                            ->downloadable()
                            ->openable()
                            ->hiddenLabel(),
                    ])
                    ->collapsible()->collapsed(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('dl_number')
                    ->searchable()->toggleable(isToggledHiddenByDefault: true)->sortable(),
                Tables\Columns\TextColumn::make('expiry_date')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('remind_before')->searchable()->toggleable()->sortable()
                    ->label('Remind before (Days)'),
                Tables\Columns\TextColumn::make('country')->searchable()->sortable()
                    ->toggleable(), //isToggledHiddenByDefault: true
                Tables\Columns\TextColumn::make('remarks')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), //isToggledHiddenByDefault: true
                IconColumn::make('active_alert')->label('Alert')->boolean(),
                IconColumn::make('attachments')
                    ->label('file')->boolean()->trueIcon('heroicon-o-document-text')->wrap(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('expiry_date')
                    ->query(fn(Builder $query): Builder => $query
                        ->whereRaw('expiry_date <= (CURRENT_DATE + INTERVAL remind_before DAY)')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDrivingLicenses::route('/'),
            'create' => Pages\CreateDrivingLicense::route('/create'),
            'edit' => Pages\EditDrivingLicense::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
