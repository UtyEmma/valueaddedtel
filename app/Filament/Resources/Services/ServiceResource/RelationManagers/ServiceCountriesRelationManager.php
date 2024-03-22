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

class ServiceCountriesRelationManager extends RelationManager
{
    protected static string $relationship = 'serviceCountries';

    public function form(Form $form): Form
    {
        $service = $this->getOwnerRecord();
        $serviceCountry = $form->getRecord();

        return $form
            ->schema([
                Forms\Components\Select::make('country_code')
                    ->label('Country')
                    ->native(false)
                    ->options(
                            Country::isSupported()
                                // ->whereDoesntHave('services', function (Builder $query) use($service) {
                                //     $query->where('shortcode', $service?->shortcode);
                                // })
                                ->pluck('name', 'iso_code')
                        )
                    ->required(),
                Forms\Components\TagsInput::make('values')
                    // ->reorderable()
                    ->label('Selectable Amounts')
                    ->nestedRecursiveRules(['numeric'])
                    ->columnSpanFull()
                    ->nullable(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->native(false)
                    ->options([
                        Status::ACTIVE->value => Status::ACTIVE->value,
                        Status::DELAYED->value => Status::DELAYED->value,
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
                TextColumn::make('country.name'),
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
