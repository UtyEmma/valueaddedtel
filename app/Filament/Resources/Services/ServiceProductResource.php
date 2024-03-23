<?php

namespace App\Filament\Resources\Services;

use App\Enums\Status;
use App\Filament\Resources\Services\ServiceProductResource\Pages;
use App\Filament\Resources\Services\ServiceProductResource\RelationManagers;
use App\Models\Countries\Country;
use App\Models\Services\Service;
use App\Models\Services\ServiceProduct;
use App\Models\Services\ServiceProvider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceProductResource extends Resource
{
    protected static ?string $model = ServiceProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Services';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_code')
                    ->options(Service::pluck('name', 'shortcode'))
                    ->native(false)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder('Name')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->preserveFilenames()
                    ->label('Logo'),
                Forms\Components\TextInput::make('shortcode')
                    ->required()
                    ->placeholder('Short Code')
                    ->maxLength(255),
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
                    ->numeric()
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

    public static function table(Table $table): Table
    {
        return $table
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
            'index' => Pages\ListServiceProducts::route('/'),
            'create' => Pages\CreateServiceProduct::route('/create'),
            'view' => Pages\ViewServiceProduct::route('/{record}'),
            'edit' => Pages\EditServiceProduct::route('/{record}/edit'),
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
