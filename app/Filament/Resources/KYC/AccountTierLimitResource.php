<?php

namespace App\Filament\Resources\KYC;

use App\Filament\Resources\KYC\AccountTierLimitResource\Pages;
use App\Filament\Resources\KYC\AccountTierLimitResource\RelationManagers;
use App\Models\KYC\AccountTierLimit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountTierLimitResource extends Resource
{
    protected static ?string $model = AccountTierLimit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'KYC';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('service_code')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('country_code')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('daily_limit')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lifetime_limit')
                    ->numeric(),
                Forms\Components\TextInput::make('single_limit')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_code')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('country_code')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('daily_limit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lifetime_limit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('single_limit')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListAccountTierLimits::route('/'),
            'create' => Pages\CreateAccountTierLimit::route('/create'),
            'view' => Pages\ViewAccountTierLimit::route('/{record}'),
            'edit' => Pages\EditAccountTierLimit::route('/{record}/edit'),
        ];
    }
}
