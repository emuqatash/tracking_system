<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers\ServicesRelationManager;
use App\Models\Service;
use App\Models\Vehicle;
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

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = "Vehicle Care";

    protected static ?string $navigationLabel = "New Vehicle\Service";
    protected static ?int $navigationSort = 4;

    //****** Customize the navbar*********/
    protected static ?string $recordTitleAttribute = 'make_model';
    protected static int $globalSearchResutsLimit = 20;

    //****** Global Search*********/

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
//        return static::getModel()::where('year', '=', '2017')->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('year', '=', '2017')->count() > 10
            ? 'warning'
            : 'primary';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['make_model', 'year', 'plate_no', 'vehicle_owner', 'vin'];
    }

    //****** Global Search*********/

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Year' => $record->year,
            'Registration' => $record->registration_date
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('make_model')
                            ->label('Make & Model')
                            // ->hint('Enter car make\brand and car model, ex: BMW 330')
                            ->helperText('make\brand and car model, ex: BMW 330')
                            ->minLength('3')
                            ->required()
                            ->dehydrateStateUsing(fn(string $state): string => ucwords($state)),
                        Forms\Components\TextInput::make('year')
                            ->integer()
                            ->length('4')
                            ->required(),
                        Forms\Components\TextInput::make('mileage_at_purchase')
                            ->integer()
                            ->required()
//                            ->mask(RawJs::make(<<<'JS'
//                                '999,999999'
//                                JS
//                            ))
                            ->minLength('1'),
                        Forms\Components\TextInput::make('plate_no')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('vin')
                            ->label('VIN')
                            ->unique(ignoreRecord: true),
                        Forms\Components\DatePicker::make('registration_date')
                            ->label('Registration Expired on')
                            ->displayFormat('d/m/Y')
                            ->native(false)
                            ->default(now())
                            ->closeOnDateSelection()
                            ->required(),
                        Forms\Components\TextInput::make('remind_before')
                            ->helperText('number of days')
                            ->default(0)
                            ->integer()
                            ->maxLength('4')
                            ->required(),
                        Forms\Components\ColorPicker::make('color'),
                        Forms\Components\TextInput::make('vehicle_owner')
                            ->default('Application User'),
                        Forms\Components\TextInput::make('owner_email')
                            ->label('Email Address')
                            ->required()
                            ->email(),
//                            ->unique(ignoreRecord: true),
                        Toggle::make('active_alert')
                            ->label('Activate Alert')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('gray')
                            ->default('gray'),
                        Forms\Components\FileUpload::make('file')
                            ->label('File or Image')
                            ->multiple()
                            ->directory('Vehicle-attachments')
                            ->storeFileNamesIn('file_original_filename')
                            ->preserveFilenames()
                            ->reorderable()
                            ->appendFiles()
                            ->downloadable()
                            ->columnSpanFull()
                            ->openable(),
                        Forms\Components\Section::make('Vehicle Note')
                            ->schema([
                                Forms\Components\MarkdownEditor::make('remarks')->columnSpanFull()
                            ])->collapsible()->collapsed()
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('make_model', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('make_model')->label('Make\Model')->searchable()->toggleable()->sortable()
                    ->formatStateUsing(fn(string $state): string => ucwords($state)),
                Tables\Columns\TextColumn::make('year')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('id')
                    ->label('Current Mileage')
                    ->formatStateUsing(function ($state) {
                        $service = Service::where('vehicle_id', $state)->latest('repair_date')->first();
                        $mileage = $service->current_mileage ?? Vehicle::find($state)->mileage_at_purchase;
                        // Add a thousands separator to the mileage
                        $mileage = number_format($mileage, 0, '.', ',');
                        return $mileage;
                    }),
                Tables\Columns\TextColumn::make('registration_date')
                    ->label('Reg. expiry date')
                    ->formatStateUsing(fn($state) => $state <= now()->subYear() ? 'N/A' : $state)
                    ->searchable()->toggleable()->sortable()->date(),
                Tables\Columns\TextColumn::make('remind_before')->searchable()->toggleable()->sortable()
                    ->label('Remind before (Days)'),
                Tables\Columns\TextColumn::make('plate_no')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('vin')->searchable()->toggleable(isToggledHiddenByDefault: true)->sortable(),
                Tables\Columns\ColorColumn::make('color')->searchable()->toggleable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('vehicle_owner')->label('Owner')->searchable()->toggleable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('active_alert')->label('Alert')->boolean(),
                IconColumn::make('file')
                    ->label('Attachments')->boolean()->trueIcon('heroicon-o-document-text')->wrap(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('registration_date')
                    ->label('Expired Registration')
                    ->query(fn(Builder $query): Builder => $query
                        ->whereRaw('registration_date <= (CURRENT_DATE + INTERVAL remind_before DAY)')),
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
                    // Tables\Actions\BulkAction::make('Delete all')
                    //     ->action(function (Collection $records) {
                    //         dd($records);
                    // $records->each(function ($record) {
                    //     $record->vehicle_id = $record->vehicle_id + 1;
                    //     $record->save();
                    // });
                    // })->requiresConfirmation()->deselectRecordsAfterCompletion()
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
            ServicesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
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
