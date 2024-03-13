<?php

namespace App\Filament\Resources\Services\ServiceResource\RelationManagers;

use App\Enums\Status;
use App\Models\Countries\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountriesRelationManager extends RelationManager {
    protected static string $relationship = 'countries';

    public function form(Form $form): Form
    {
        $service = $this->getOwnerRecord();
        return $form
            ->schema([
                Forms\Components\Select::make('country_code')
                    ->label('Country')
                    ->native(false)
                    ->options(
                            Country::isSupported()
                                ->whereDoesntHave('services', function (Builder $query) use($service) {
                                    $query->where('shortcode', $service?->shortcode);
                                })
                                ->pluck('name', 'iso_code')
                        )
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->native(false)
                    ->options([
                        Status::ACTIVE->value => Status::ACTIVE->value,
                        Status::INACTIVE->value => Status::INACTIVE->value,
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('shortcode')
            ->columns([
                TextColumn::make('name'),
                IconColumn::make('is_default')
                    ->boolean()
                    ->label('Default'),
                TextColumn::make('status')
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