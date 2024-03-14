<?php

namespace App\Filament\Resources\Payments\PaymentMethodResource\RelationManagers;

use App\Enums\Status;
use App\Models\Countries\Country;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentMethodCountriesRelationManager extends RelationManager
{
    protected static string $relationship = 'paymentMethodCountries';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('country_code')
                    ->label('Country')
                    ->options(Country::pluck('name', 'iso_code')),
                Select::make('status')
                    ->options([
                        Status::ACTIVE->value => Status::ACTIVE->value,
                        Status::INACTIVE->value => Status::INACTIVE->value,
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('shortcode')
            ->columns([
                Tables\Columns\TextColumn::make('country.name')
                    ->label('Country'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
