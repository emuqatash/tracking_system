<?php

namespace App\Filament\Resources;

use App\Filament\Exports\BusinessExpenseExporter;
use App\Filament\Resources\BusinessExpenseResource\Pages;
use App\Models\BusinessCompany;
use App\Models\BusinessExpense;
use App\Models\BusinessExpenseCategory;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class BusinessExpenseResource extends Resource
{
    protected static ?string $model = BusinessExpense::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = "Business Expenses";
    protected static ?string $navigationLabel = "New Expense";
    protected static ?int $navigationSort = 7;

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
        return static::getModel()::where('amount', '>=', '100')->count() > 10
            ? 'warning'
            : 'primary';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['subject', 'description', 'businessExpenseCategory.name', 'business_expense_categories_id', 'sub_category'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Category' => BusinessExpenseCategory::find($record->business_expense_categories_id)->name ?? null,
            'Action' => $record->sub_category,
        ];
    }

    //****** Global Search*********/

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // you need run: php artisan make:filament-exporter BusinessExpense --generate
                ExportAction::make()
                    ->exporter(BusinessExpenseExporter::class)
            ])
            ->defaultSort('expense_date')
            ->columns([
                Tables\Columns\TextColumn::make('subject')->searchable()->toggleable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('business_companies_id')->searchable()->toggleable()->sortable()
                    ->label('Company')
                    ->formatStateUsing(function ($state) {
                        $category = BusinessCompany::find($state);
                        return $category->name;
                    }),
                Tables\Columns\TextColumn::make('business_expense_categories_id')->searchable()->toggleable()->sortable()
                    ->label('Category')
                    ->formatStateUsing(function ($state) {
                        $category = BusinessExpenseCategory::find($state);
                        return $category->name;
                    }),
                Tables\Columns\TextColumn::make('sub_category')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('expense_date')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('amount')->toggleable()->sortable(),
                TextColumn::make('amount')->summarize(Sum::make()),
                IconColumn::make('file')->boolean()->trueIcon('heroicon-o-document-text')->wrap(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Filter::make('expense_date')
                    ->form([
                        DatePicker::make('From'),
                        DatePicker::make('To'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['From'],
                                fn(Builder $query, $date): Builder => $query->whereDate('expense_date', '>=', $date),
                            )
                            ->when(
                                $data['To'],
                                fn(Builder $query, $date): Builder => $query->whereDate('expense_date', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ReplicateAction::make()
                        ->beforeReplicaSaved(function (BusinessExpense $replica): void {
                            $replica->subject = '[New] ' . $replica->subject;
                        })
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Record replicated')
                                ->body('The record has been replicated successfully.'),
                        )
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject')
                    ->minLength('4')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('description')
                    ->label('Description or Notes')
                    ->columnSpanFull(),
                Forms\Components\Select::make('business_expense_categories_id')
                    ->label('Category')
                    ->relationship('businessExpenseCategory', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required(),
                Forms\Components\TextInput::make('sub_category')
                    ->label('Sub Category'),
                Forms\Components\Select::make('business_companies_id')
                    ->label('Company')
                    ->relationship('businessCompany', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->default('United States')
                    ->required(),
                Forms\Components\DatePicker::make('expense_date')
                    ->label('Date')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->required()
                    ->default(now()),
                Forms\Components\TextInput::make('amount')
                    ->required(),
                Forms\Components\Select::make('country')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->default('United States')
                    ->options(Country::pluck('name', 'name')),
                Forms\Components\FileUpload::make('file')
                    ->label('File or Image')
                    ->multiple()
                    ->directory('BusinessExpense-attachments')
                    ->storeFileNamesIn('file_original_filename')
                    ->preserveFilenames()
                    ->reorderable()
                    ->appendFiles()
                    ->downloadable()
                    ->columnSpanFull()
                    ->openable(),
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
            'index' => Pages\ListBusinessExpenses::route('/'),
            'create' => Pages\CreateBusinessExpense::route('/create'),
            'edit' => Pages\EditBusinessExpense::route('/{record}/edit'),
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
