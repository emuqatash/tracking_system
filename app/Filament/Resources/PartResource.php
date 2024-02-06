<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartResource\Pages;
use App\Filament\Resources\PartResource\RelationManagers;
use App\Models\Part;
use App\Models\Scopes\AccountScope;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Unique;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PartResource extends Resource
{
    protected static ?string $model = Part::class;

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static ?string $navigationGroup = "Vehicle Care";

    protected static ?string $navigationLabel = "Part";

    protected static ?int $navigationSort = 6;

//    public static function getNavigationBadge(): ?string
//    {
//        return static::getModel()::count();
//    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->unique(modifyRuleUsing: function (Unique $rule, callable $get) { // $get callable is used
                        return $rule
                            ->where('name', $get('name'))
                            ->where('account_id', $get('account_id'));
                    }, ignoreRecord: true)
                    ->required()
                    ->dehydrateStateUsing(fn(string $state): string => ucwords($state))
            ]);
    }

    public static function table(Table $table): Table
    {
        $table->modifyQueryUsing(function (Builder $query) {
            $accountId = session()->get('account_id');
            $query->withoutGlobalScopes([AccountScope::class])->where(function (Builder $query) use ($accountId) {
                $query->whereNull('account_id')->orWhere('account_id', $accountId);
            });
        });

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('account_id')
                    ->formatStateUsing(fn($state) => $state != null ? auth()->user()->name : 'SysAdmin')
                    ->label('Created by')
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                    //*************Below comment to add one more Action on Bulk************/
//                    Tables\Actions\BulkAction::make('Write on Laravel.log')
//                        ->icon('heroicon-s-currency-dollar')
//                        ->action(function (Collection $records) {
//                            $records->each(function ($record) {
//                                event(new PartDeleted($record));
//                            });
//                        })
//                        ->requiresConfirmation()
//                        ->deselectRecordsAfterCompletion()
                    /****************************End of Comment*********************************/
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
            'index' => Pages\ListParts::route('/'),
        ];
    }
}
