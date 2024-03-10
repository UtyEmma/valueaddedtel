<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountTierResource\Pages;
use App\Filament\Resources\AccountTierResource\RelationManagers;
use App\Models\AccountTier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountTierResource extends Resource
{
    protected static ?string $model = AccountTier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('level')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('max_balance')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('max_deposit')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('max_withdrawal')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_default')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('level')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_balance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_deposit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_withdrawal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_default')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAccountTiers::route('/'),
            'create' => Pages\CreateAccountTier::route('/create'),
            'view' => Pages\ViewAccountTier::route('/{record}'),
            'edit' => Pages\EditAccountTier::route('/{record}/edit'),
        ];
    }
}
