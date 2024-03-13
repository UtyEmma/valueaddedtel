<?php

namespace App\Filament\Resources\AccountTierResource\RelationManagers;

use App\Models\Countries\Country;
use App\Models\KYC\AccountTier;
use App\Models\Services\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LimitsRelationManager extends RelationManager
{
    protected static string $relationship = 'limits';

    public function form(Form $form): Form {
        $tier = $this->getOwnerRecord();
        return $form
            ->schema([
                Forms\Components\Select::make('tier_id')
                    ->options(AccountTier::where('id', $tier?->id)->pluck('name', 'id'))
                    ->label('Account Tier')
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('country_code')
                    ->options(Country::has('currency')->pluck('name', 'iso_code'))
                    ->label('Country')
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('service_code')
                    ->options(Service::pluck('name', 'shortcode'))
                    ->label('Service')
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('daily_limit')
                    ->numeric()
                    ->placeholder('Amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table {
        return $table
            ->recordTitleAttribute('tier_id')
            ->columns([
                Tables\Columns\TextColumn::make('tier.name')
                    ->label('Tier'),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service'),
                Tables\Columns\TextColumn::make('country.name')
                    ->label('Country'),
                Tables\Columns\TextColumn::make('daily_limit')
                    ->formatStateUsing(function(string $state, Model $record){
                        $currency = $record->country->currency;
                        return implode(' ', [$currency->symbol, number_format($state, 2)]);
                    }),
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
