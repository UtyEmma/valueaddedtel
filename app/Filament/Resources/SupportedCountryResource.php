<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\SupportedCountryResource\Pages;
use App\Filament\Resources\SupportedCountryResource\RelationManagers;
use App\Models\Countries\Country;
use App\Models\Countries\SupportedCountry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupportedCountryResource extends Resource
{
    protected static ?string $model = SupportedCountry::class;
    protected static ?string $navigationGroup = 'Countries';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('country_id')
                    ->options(Country::pluck('name', 'id'))
                    ->native(false)
                    ->label('Country')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->required()
                    ->native(false)
                    ->options([
                        Status::ACTIVE->value => Status::ACTIVE->value,
                        Status::INACTIVE->value => Status::INACTIVE->value,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country.name')
                    ->label('Country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListSupportedCountries::route('/'),
            'create' => Pages\CreateSupportedCountry::route('/create'),
            'view' => Pages\ViewSupportedCountry::route('/{record}'),
            'edit' => Pages\EditSupportedCountry::route('/{record}/edit'),
        ];
    }
}
