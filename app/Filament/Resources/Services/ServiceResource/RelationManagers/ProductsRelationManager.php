<?php

namespace App\Filament\Resources\Services\ServiceResource\RelationManagers;

use App\Enums\Status;
use App\Models\Countries\Country;
use App\Models\Services\ServiceProvider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public $providers = [];

    public function form(Form $form): Form {
        $service = $this->getOwnerRecord();
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder('Name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('shortcode')
                    ->required()
                    ->placeholder('Short Code')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->preserveFilenames()
                    ->label('Logo'),
                Forms\Components\Select::make('country_code')
                    ->label('Country')
                    ->native(false)
                    ->options(
                        Country::isSupported()
                            ->pluck('name', 'iso_code')
                    )
                    ->required(),
                Forms\Components\Select::make('provider_code')
                    ->label('Service Provider')
                    ->native(false)
                    ->options(function (Get $get) {
                        $code =  $get('country_code');
                        $providers = ServiceProvider::whereRelation('providerCountries', 'country_code', $code)->pluck('name', 'shortcode');
                        return $providers;
                    })
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->placeholder('Amount')
                    ->mask(RawJs::make('$money($input)'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('cashback')
                    ->placeholder('Cashback'),
                Forms\Components\Select::make('cashback_type')
                    ->native(false)
                    ->options([
                        'percent' => 'Percent',
                        'fixed' => 'Fixed',
                    ])
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
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service'),
                Tables\Columns\TextColumn::make('provider.name')
                    ->label('Provider'),
                Tables\Columns\TextColumn::make('country.name')
                    ->label('Country'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('cashback')
                    ->suffix('%'),
                Tables\Columns\TextColumn::make('cashback_type'),
                Tables\Columns\TextColumn::make('shortcode'),
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
