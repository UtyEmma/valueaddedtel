<?php

namespace App\Filament\Resources\Services\ServiceProviderResource\RelationManagers;

use App\Enums\Status;
use App\Models\Countries\Country;
use App\Models\Services\ServiceProvider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProviderCountriesRelationManager extends RelationManager
{
    protected static string $relationship = 'providerCountries';

    public function form(Form $form): Form {
        $provider = $this->getOwnerRecord();
        return $form
            ->schema([
                Forms\Components\Select::make('country_code')
                    ->options(Country::pluck('name', 'iso_code'))
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        Status::ACTIVE->value => Status::ACTIVE->value,
                        Status::INACTIVE->value => Status::INACTIVE->value,
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table {
        return $table
            ->recordTitleAttribute('shortcode')
            ->columns([
                Tables\Columns\TextColumn::make('country.name'),
                Tables\Columns\TextColumn::make('provider.name'),
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
