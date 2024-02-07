<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Scopes\AccountScope;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\View\Components\Modal;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = "SETTINGS";
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {

        Modal::closedByClickingAway(false);
        
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('email_verified_at'),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->maxLength(255),
                        Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->preload(),
                        Select::make('permissions')
                            ->multiple()
                            ->relationship('permissions', 'name')
                            ->preload(),
//                        Forms\Components\TextInput::make('account_id')
//                            ->default(session('account_id'))
//                            ->hidden()
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        if (auth()->user() && auth()->user()->hasRole('Admin')) {
            $table->modifyQueryUsing(fn(Builder $query) => $query->withoutGlobalScopes([
                AccountScope::class,
            ]));
        }

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('account_id')
                    ->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->limit(15)->toggleable()
                    ->tooltip(fn($record): string => $record->roles->pluck('name')->implode(', ')),
                Tables\Columns\TextColumn::make('permissions.name')
                    ->limit(15)->toggleable()
                    ->tooltip(fn($record): string => $record->permissions->pluck('name')->implode(', ')),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListUsers::route('/'),
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
