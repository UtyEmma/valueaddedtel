<?php

namespace App\Filament\Resources\Payments;

use App\Enums\Status;
use App\Filament\Resources\Payments\PaymentMethodResource\Pages;
use App\Filament\Resources\Payments\PaymentMethodResource\RelationManagers;
use App\Filament\Resources\Payments\PaymentMethodResource\RelationManagers\PaymentMethodCountriesRelationManager;
use App\Models\Transactions\PaymentMethod;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentMethodResource extends Resource
{
    protected static ?string $model = PaymentMethod::class;

    protected static ?string $navigationGroup = 'Payments';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->nullable()
                    ->image(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('shortcode')
                    ->unique(ignoreRecord: true)
                    ->required(),
                KeyValue::make('meta')
                    ->columnSpanFull()
                    ->deletable(false)
                    ->addable(false),
                Select::make('mode')
                    ->native(false)
                    ->options([
                        'test' => 'Test',
                        'live' => "Live",
                    ]),
                Select::make('status')
                    ->native(false)
                    ->options([
                        Status::ACTIVE->value => Status::ACTIVE->value,
                        Status::INACTIVE->value => Status::INACTIVE->value,
                    ]),
                Toggle::make('isOnline')
                    ->default(true)
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('shortcode'),
                IconColumn::make('isOnline')->boolean(),
                TextColumn::make('status'),
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
            PaymentMethodCountriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentMethods::route('/'),
            'create' => Pages\CreatePaymentMethod::route('/create'),
            'view' => Pages\ViewPaymentMethod::route('/{record}'),
            'edit' => Pages\EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
