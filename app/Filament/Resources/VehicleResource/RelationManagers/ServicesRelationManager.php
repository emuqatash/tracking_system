<?php

namespace App\Filament\Resources\VehicleResource\RelationManagers;

use App\Models\Part;
use App\Models\Shop;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\View\Components\Modal;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ServicesRelationManager extends RelationManager
{

    //****** Global Search*********/

    protected static string $relationship = 'services';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('current_mileage', 'desc')
            ->recordTitleAttribute('part_id')
            ->columns([
                Tables\Columns\TextColumn::make('part_id')
                    ->label('Part')
                    ->formatStateUsing(function ($state) {
                        return Part::withoutGlobalScopes()->find($state)->name;
                    })->searchable()->toggleable()->sortable()->wrap(),

//                    ->searchable(query: function (Builder $query, string $search): Builder {
//                        $debugQuery = $query->leftJoin('parts', 'services.part_id', '=', 'parts.id')
//                            ->where('parts.name', 'like', "%{$search}%")
//                            ->toSql(); // Get the raw SQL query//
//                        Log::info($debugQuery); // Log the query to storage/logs/laravel.log
//                        return $query->leftJoin('parts', 'services.part_id', '=', 'parts.id')
//                            ->where('parts.name', 'like', "%{$search}%");
//                    })
//
//                Tables\Columns\TextColumn::make('part.name')->searchable()->wrap(),

                Tables\Columns\TextColumn::make('shop_id')
                    ->label('Shop')
                    ->formatStateUsing(function ($state) {
                        return Shop::withoutGlobalScopes()->find($state)->name;
                    })
                    ->searchable()->toggleable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('current_mileage')->toggleable()->sortable()
                    ->numeric(
                        decimalPlaces: 0,
                        decimalSeparator: '.',
                        thousandsSeparator: ',',
                    ),
                Tables\Columns\TextColumn::make('part_warranty_period')
                    ->formatStateUsing(fn($state) => $state === '0.0' ? 'N/A' : $state)
                    ->label('Part Warranty Y/M')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('labor_warranty_period')
                    ->formatStateUsing(fn($state) => $state === '0.0' ? 'N/A' : $state)
                    ->label('Labor Warranty Y/M')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('followup_mileage')
                    ->sortable()
                    ->formatStateUsing(fn($state) => is_null($state) || $state === ' ' ? 'N/A' : $state)
                    ->label('followup On(Mile)'),
                Tables\Columns\TextColumn::make('followup_date')
                    ->sortable()
                    ->formatStateUsing(fn($state) => is_null($state) || $state === ' ' ? 'N/A' : $state)
                    ->label('followup Date'),
                Tables\Columns\TextColumn::make('repair_date')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('part_cost')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('labor_cost')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_cost')->sortable(),
                IconColumn::make('active_alert')->label('Alert')->boolean(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('followup_mileage')
                    ->label('Service require follow up')
                    ->query(fn(Builder $query): Builder => $query->where('followup_mileage', '!=', null)
                        ->orWhere('followup_date', '!=', null)
                    ),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->mutateFormDataUsing(function (array $data): array {
                            $data['total_cost'] = $data['part_cost'] + $data['labor_cost'];
                            return $data;
                        }),
                    Tables\Actions\DeleteAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Delete Service')
                                ->body('The user has been force-deleted successfully.'),
                        ),
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

    public function form(Form $form): Form
    {
        Modal::closedByClickingAway(false);

        return $form
            ->schema([
                Toggle::make('active_alert')
                    ->label('Activate Alert')
                    ->onColor('success')
                    ->offColor('gray')
                    ->default('gray'),
                Forms\Components\Tabs::make('Main')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Service Details')
                            ->icon('heroicon-o-wrench-screwdriver')
                            ->schema([
                                Forms\Components\Select::make('part_id')
                                    ->relationship(
                                        name: 'part',
                                        titleAttribute: 'name',
                                        modifyQueryUsing: function (Builder $query) {
                                            $query->withoutGlobalScopes()
                                                ->where(function ($query) {
                                                    $query->whereNull('account_id')
                                                        ->orWhere('account_id', session()->get('account_id'));
                                                });
                                        },
                                    )
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->preload()
                                    ->label('Part Name')
                                    ->live(onBlur: true)
                                    ->searchable()
                                    ->native(false),
                                Forms\Components\Select::make('shop_id')
                                    ->relationship(
                                        name: 'shop',
                                        titleAttribute: 'name',
                                        modifyQueryUsing: function (Builder $query) {
                                            $query->withoutGlobalScopes()
                                                ->where(function ($query) {
                                                    $query->whereNull('account_id')
                                                        ->orWhere('account_id', session()->get('account_id'));
                                                });
                                        },
                                    )
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->preload()
                                    ->required(fn(Get $get): bool => filled($get('part_id')))
                                    ->searchable()
                                    ->label('Shop Name'),
                                Forms\Components\DatePicker::make('repair_date')
                                    ->required(fn(Get $get): bool => filled($get('part_id')))
                                    ->closeOnDateSelection()
                                    ->default(now()),
                                Forms\Components\TextInput::make('part_cost')
                                    ->live()
                                    ->dehydrated()
                                    ->prefixIcon('heroicon-m-currency-dollar')
                                    ->default(0.00)
                                    ->numeric()
                                    ->required(fn(Get $get): bool => filled($get('part_id')))
                                    ->rules('regex:/^\d{1,6}(\.\d{0,2})?$/'),
//                                    ->afterStateUpdated(function (Get $get, Set $set) {
//                                        $set('total_cost', floatval($get('part_cost')) + floatval($get('labor_cost')));
//                                    }),
                                Forms\Components\TextInput::make('labor_cost')
                                    ->live()
                                    ->dehydrated()
                                    ->prefixIcon('heroicon-m-currency-dollar')
                                    ->default(0.00)
                                    ->numeric()
                                    ->required(fn(Get $get): bool => filled($get('part_id')))
                                    ->rules('regex:/^\d{1,6}(\.\d{0,2})?$/'),
                                Forms\Components\Placeholder::make('total_cost')
                                    ->content(function ($get) {
                                        return $get('part_cost') + $get('labor_cost');
                                    }),
                                Forms\Components\TextInput::make('current_mileage')
                                    ->required(fn(Get $get): bool => filled($get('part_id')))
                                    ->default(0)
                                    ->integer(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Warranty terms')
                            ->schema([
                                Forms\Components\TextInput::make('part_warranty_period')
                                    // ->dehydrated()
                                    ->label('Part')
                                    ->numeric()
                                    ->placeholder('0.0')
                                    ->helperText('Warranty Period YY.M')
                                    ->default(0),
                                Forms\Components\TextInput::make('labor_warranty_period')
                                    // ->dehydrated()
                                    ->label('Labor')
                                    ->helperText('Labor Warranty YY.M')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        Forms\Components\Tabs\Tab::make('Attachments')
                            ->schema([
                                Forms\Components\FileUpload::make('file')
                                    ->label('File')
                                    ->multiple()
                                    ->directory('file-attachments')
                                    ->storeFileNamesIn('file_original_filename')
                                    ->preserveFilenames()
                                    ->reorderable()
                                    ->openable(),
                                Forms\Components\FileUpload::make('image')
                                    ->label('Photo')
                                    ->directory('image-attachments')
                                    ->storeFileNamesIn('image_original_filename')
                                    ->acceptedFileTypes([
                                        'application/jpg', 'application/jpeg', 'application/png'
                                    ])
                                    ->openable()
                                    ->preserveFilenames()
                                    ->image()
                                    ->imageEditor(),
                                // ->grow(false),
                            ]),

                        Forms\Components\Tabs\Tab::make('Follow Up')
                            ->schema([
                                Forms\Components\TextInput::make('followup_mileage')
                                    ->integer()
//                                    ->mask(RawJs::make(<<<'JS'
//                                        '999,999999'
//                                        JS
//                                    ))
                                    ->minLength('1'),
                                Forms\Components\DatePicker::make('followup_date')
                                    ->afterOrEqual('today')
                                    ->closeOnDateSelection()
                            ]),

                        Forms\Components\Tabs\Tab::make('Note')
                            ->schema([
                                Forms\Components\MarkdownEditor::make('remarks')
                                    ->columnSpanFull()
                                    ->hint('Translatable')
                                    ->hintIcon('heroicon-m-language')
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['total_cost'] = $data['part_cost'] + $data['labor_cost'];
        return $data;
    }
}
