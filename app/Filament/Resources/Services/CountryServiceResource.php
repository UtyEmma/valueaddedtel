<?php

namespace App\Filament\Resources\Services;

use App\Filament\Resources\Services\CountryServiceResource\Pages;
use App\Filament\Resources\Services\CountryServiceResource\RelationManagers;
use App\Models\Services\CountryService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryServiceResource extends Resource
{
    protected static ?string $model = CountryService::class;
    protected static ?string $navigationGroup = 'Services';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('service.name'),
                TextColumn::make('country.name'),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListCountryServices::route('/'),
            'create' => Pages\CreateCountryService::route('/create'),
            'view' => Pages\ViewCountryService::route('/{record}'),
            'edit' => Pages\EditCountryService::route('/{record}/edit'),
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
