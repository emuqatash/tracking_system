<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MiscellaneousResource\Pages;
use App\Models\Miscellaneous;
use App\Models\MiscellaneousCategory;
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

class MiscellaneousResource extends Resource
{
    protected static ?string $model = Miscellaneous::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = "Miscellaneous";
    protected static ?string $navigationLabel = "New Mis.";
    protected static ?int $navigationSort = 8;

    //****** Customize the navbar*********/
    protected static ?string $recordTitleAttribute = 'subject';
    protected static int $globalSearchResutsLimit = 20;

    //****** Global Search*********/
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('cost', '>=', '100')->count() > 10
            ? 'warning'
            : 'primary';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['subject', 'description', 'miscellaneousCategory.name', 'miscellaneous_categories_id', 'sub_category'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Category' => MiscellaneousCategory::find($record->miscellaneous_categories_id)->name ?? null,
            'Action' => $record->sub_category,
        ];
    }

    //****** Global Search*********/
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->minLength('4')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\MarkdownEditor::make('description')->columnSpanFull(),
                        Forms\Components\Select::make('miscellaneous_categories_id')
                            ->label('Category')
                            ->relationship('miscellaneousCategory', 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('sub_category')
                            ->label('Sub Category'),
                        Forms\Components\DatePicker::make('followup_date')
                            ->displayFormat('d/m/Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->default(now()),
                        Forms\Components\TextInput::make('followup_before_day')
                            ->label('Alert before (day) of followup date')
                            ->integer()
                            ->default(0),
                        Forms\Components\TextInput::make('purchased_from')
                            ->label('Purchased from\Link'),
                        Toggle::make('active_alert')
                            ->label('Activate Alert')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('gray')
                            ->default('gray'),
                        Forms\Components\TextInput::make('cost')
                            ->default(0.00),
                        Forms\Components\FileUpload::make('file')
                            ->label('File or Image')
                            ->multiple()
                            ->directory('miscellaneous-attachments')
                            ->storeFileNamesIn('file_original_filename')
                            ->preserveFilenames()
                            ->reorderable()
                            ->appendFiles()
                            ->downloadable()
                            ->openable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('followup_date')
            ->columns([
                Tables\Columns\TextColumn::make('subject')->searchable()->toggleable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('miscellaneous_categories_id')->searchable()->toggleable()->sortable()
                    ->label('Category')
                    ->formatStateUsing(function ($state) {
                        $category = MiscellaneousCategory::find($state);
                        return $category->name;
                    }),
                Tables\Columns\TextColumn::make('sub_category')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('followup_date')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('followup_before_day')->label('Alert before(Day)')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('cost')->toggleable()->sortable(),
                IconColumn::make('active_alert')->label('Alert')->boolean(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
            'index' => Pages\ListMiscellaneouses::route('/'),
            'create' => Pages\CreateMiscellaneous::route('/create'),
            'edit' => Pages\EditMiscellaneous::route('/{record}/edit'),
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
