<?php

namespace App\Filament\Resources\Services\ServicePaymentMethodResource\RelationManagers;

use App\Enums\Status;
use App\Models\Countries\Country;
use App\Models\Services\Service;
use App\Models\Transactions\PaymentMethod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServicePaymentMethodsRelationManager extends RelationManager {

    protected static string $relationship = 'servicePaymentMethods';

    public function form(Form $form): Form
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
                Forms\Components\Select::make('status')
                    ->required()
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
                TextColumn::make('service.name'),
                TextColumn::make('country.name'),
                TextColumn::make('paymentMethod.name'),
                TextColumn::make('status')
                    ->badge(),
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
