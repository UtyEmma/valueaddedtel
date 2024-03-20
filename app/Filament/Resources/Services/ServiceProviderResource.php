<?php

namespace App\Filament\Resources\Services;

use App\Enums\Status;
use App\Filament\Resources\Services\ServiceProviderResource\Pages\CreateServiceProvider;
use App\Filament\Resources\Services\ServiceProviderResource\Pages\EditServiceProvider;
use App\Filament\Resources\Services\ServiceProviderResource\Pages\ListServiceProviders;
use App\Filament\Resources\Services\ServiceProviderResource\Pages\ViewServiceProvider;
use App\Filament\Resources\Services\ServiceProviderResource\RelationManagers;
use App\Filament\Resources\Services\ServiceProviderResource\RelationManagers\CountriesRelationManager;
use App\Filament\Resources\Services\ServiceProviderResource\RelationManagers\ProviderCountriesRelationManager;
use App\Models\Services\ServiceProvider;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceProviderResource extends Resource
{
    protected static ?string $model = ServiceProvider::class;

    protected static ?string $navigationGroup = 'Services';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->placeholder('Name')
                    ->maxLength(255),
                TextInput::make('shortcode')
                    ->required()
                    ->placeholder('Shortcode')
                    ->unique()
                    ->maxLength(255),
                KeyValue::make('meta')
                    ->columnSpanFull()
                    ->deletable(false)
                    ->addable(false),
                Select::make('status')
                    ->options([
                        Status::ACTIVE->value => Status::ACTIVE->value,
                        Status::DELAYED->value => Status::DELAYED->value,
                        Status::INACTIVE->value => Status::INACTIVE->value,
                    ])
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
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
            ProviderCountriesRelationManager::class
        ];
    }

    public static function getPages(): array {
        return [
            'index' => ListServiceProviders::route('/'),
            'create' => CreateServiceProvider::route('/create'),
            'view' => ViewServiceProvider::route('/{record}'),
            'edit' => EditServiceProvider::route('/{record}/edit'),
        ];
    }


}
