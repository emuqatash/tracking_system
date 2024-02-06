<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Part;
use App\Models\Service;
use App\Models\Shop;
use App\Models\Vehicle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationGroup = "Vehicle Care";

    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = "Services List";
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $recordTitleAttribute = 'vehicle_id';

    //****** to hide button Create*********/

    public static function canCreate(): bool
    {
        return false;
    }

    //****** Global Search*********/
    public static function getGloballySearchableAttributes(): array
    {
        return ['vehicle.make_model', 'part.name', 'shop.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Part' => Part::withoutGlobalScopes()->find($record->part_id)->name,

//            'Part' => Part::Query()->withoutGlobalScopes()
//                ->select('name')->where('id', $record->part_id)->first(),

//            'Part' => Service::withoutGlobalScopes()->with([
//                'part' => function ($query) {
//                    $query->withoutGlobalScopes();
//                }
//            ])->where('part.id', '=', $record->part_id)
//                ->value('name'),

            'Shop' => Shop::withoutGlobalScopes()->find($record->shop_id)->name,
            'Repair Date' => $record->repair_date,
        ];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return ServiceResource::getUrl('edit', ['record' => $record]);
    }

    //****** Global Search*********/

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('current_mileage', 'desc')
            ->recordTitleAttribute('vehicle_id')
            ->columns([
                Tables\Columns\TextColumn::make('vehicle_id')
                    ->label('Vehicle')
                    ->formatStateUsing(function ($state) {
                        return Vehicle::withoutGlobalScopes()->find($state)->make_model;
                    })
                    ->searchable()->toggleable()->sortable()->wrap(),

                Tables\Columns\TextColumn::make('part_id')
                    ->label('Part')
                    ->formatStateUsing(function ($state) {
                        return Part::withoutGlobalScopes()->find($state)->name;
                    })->toggleable()->sortable()->searchable(['part_id'])
//                    ->searchable(query: function (Builder $query, string $search): Builder {
//                        return $query
//                            ->with([
//                                'part' => function ($query) use ($search) {
//                                    $query->where('part.name', 'like', "%{$search}%")->withoutGlobalScopes();
//                                }
//                            ]);
//                    })
                    ->wrap(),

//                Tables\Columns\TextColumn::make('Part.name')->searchable()->wrap(),

                Tables\Columns\TextColumn::make('shop_id')
                    ->label('Shop')
                    ->formatStateUsing(function ($state) {
                        return Shop::withoutGlobalScopes()->find($state)->name;
                    })
                    ->searchable()->toggleable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('current_mileage')->toggleable()->sortable()
                    ->numeric(
                        decimalPlaces: 0,
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

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('followup_mileage')
                    ->label('Service require follow up')
                    ->query(fn(Builder $query): Builder => $query->where('followup_mileage', '!=', null)
                        ->orWhere('followup_date', '!=', null)
                    ),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('repair_date'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['repair_date'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->mutateFormDataUsing(function (array $data): array {
                            $data['total_cost'] = $data['part_cost'] + $data['labor_cost'];
                            return $data;
                        }),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Tabs::make('Main')
                    ->tabs([
                        Tabs\Tab::make('Service Details')
                            ->schema([
                                Select::make('part_id')
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
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->preload()
                                    ->label('Part Name')
                                    ->live(onBlur: true)
                                    ->searchable()
                                    ->native(false),
                                Select::make('shop_id')
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
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->preload()
                                    ->required(fn(Get $get): bool => filled($get('part_id')))
                                    ->searchable()
                                    ->label('Shop Name'),
                                DatePicker::make('repair_date')
                                    ->required(fn(Get $get): bool => filled($get('part_id')))
                                    ->closeOnDateSelection()
                                    ->default(now()),
                                TextInput::make('part_cost')
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
                                TextInput::make('labor_cost')
                                    ->live()
                                    ->dehydrated()
                                    ->prefixIcon('heroicon-m-currency-dollar')
                                    ->default(0.00)
                                    ->numeric()
                                    ->required(fn(Get $get): bool => filled($get('part_id')))
                                    ->rules('regex:/^\d{1,6}(\.\d{0,2})?$/'),
                                Placeholder::make('total_cost')
                                    ->content(function ($get) {
                                        return $get('part_cost') + $get('labor_cost');
                                    }),
                                TextInput::make('current_mileage')
                                    ->required(fn(Get $get): bool => filled($get('part_id')))
                                    ->default(0)
                                    ->integer(),
                            ]),
                        Tabs\Tab::make('Warranty terms')
                            ->schema([
                                TextInput::make('part_warranty_period')
                                    // ->dehydrated()
                                    ->label('Part')
                                    ->numeric()
                                    ->placeholder('0.0')
                                    ->helperText('Warranty Period YY/M')
                                    ->default(0),
                                TextInput::make('labor_warranty_period')
                                    // ->dehydrated()
                                    ->label('Labor')
                                    ->helperText('Labor Warranty YY/M')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        Tabs\Tab::make('Attachments')
                            ->schema([
                                FileUpload::make('file')
                                    ->label('File')
                                    ->multiple()
                                    ->directory('file-attachments')
                                    ->storeFileNamesIn('file_original_filename')
                                    ->preserveFilenames()
                                    ->reorderable()
                                    ->openable(),
                                FileUpload::make('image')
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
                            ]),

                        Tabs\Tab::make('Follow Up')
                            ->schema([
                                TextInput::make('followup_mileage')
                                    ->integer()
                                    ->minLength('1'),
                                DatePicker::make('followup_date')
                                    ->afterOrEqual('today')
                                    ->closeOnDateSelection()
                            ]),

                        Tabs\Tab::make('Note')
                            ->schema([
                                MarkdownEditor::make('remarks')
                                    ->columnSpanFull()
                                    ->hint('Translatable')
                                    ->hintIcon('heroicon-m-language')
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    //****** Global Search*********/

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'view' => Pages\ViewService::route('/{record}'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
