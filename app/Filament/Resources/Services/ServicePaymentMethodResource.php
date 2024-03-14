<?php

namespace App\Filament\Resources\Services;

use App\Enums\Status;
use App\Filament\Resources\Services\ServicePaymentMethodResource\Pages;
use App\Filament\Resources\Services\ServicePaymentMethodResource\RelationManagers;
use App\Models\Countries\Country;
use App\Models\Services\Service;
use App\Models\Services\ServicePaymentMethod;
use App\Models\Transactions\PaymentMethod;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServicePaymentMethodResource extends Resource
{
    protected static ?string $model = ServicePaymentMethod::class;
    protected static ?string $navigationGroup = 'Services';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('country_code')
                    ->label('Country')
                    ->options(Country::pluck('name', 'iso_code'))
                    ->required(),
                Forms\Components\Select::make('payment_method_code')
                    ->required()
                    ->label('Payment Method')
                    ->options(PaymentMethod::pluck('name', 'shortcode')),
                Forms\Components\Select::make('service_code')
                    ->required()
                    ->label('Service')
                    ->options(Service::pluck('name', 'shortcode')),
                Select::make('status')
                    ->options([
                        Status::ACTIVE->value => Status::ACTIVE->value,
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
                TextColumn::make('service.name'),
                TextColumn::make('country.name'),
                TextColumn::make('paymentMethod.name'),
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
            'index' => Pages\ListServicePaymentMethods::route('/'),
            'create' => Pages\CreateServicePaymentMethod::route('/create'),
            'view' => Pages\ViewServicePaymentMethod::route('/{record}'),
            'edit' => Pages\EditServicePaymentMethod::route('/{record}/edit'),
        ];
    }
}
