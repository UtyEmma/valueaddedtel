<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Countries\Country;
use App\Models\Countries\Currency;
use App\Models\KYC\AccountTier;
use App\Models\Packages\Package;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('avatar')
                    ->avatar()
                    ->image(),
                Forms\Components\TextInput::make('firstname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lastname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique('users', 'email', ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('username')
                    ->required()
                    ->unique('users', 'username', ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->unique('users', 'phone', ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('country_code')
                    ->label("Country")
                    ->options(Country::isSupported()->pluck('name', 'iso_code'))
                    ->required()
                    ->native(false),
                Forms\Components\Select::make('currency_code')
                    ->label("Currency")
                    ->options(Currency::pluck('name', 'code'))
                    ->required()
                    ->native(false),
                Forms\Components\Select::make('package_id')
                    ->label("Package")
                    ->options(Package::pluck('name', 'id'))
                    ->required()
                    ->native(false),
                Forms\Components\Select::make('tier_id')
                    ->label("Account Tier")
                    ->options(AccountTier::pluck('name', 'id'))
                    ->required()
                    ->native(false),
                Forms\Components\Select::make('referrer_id')
                    ->label("Referrer")
                    ->searchable()
                    ->options(User::pluck('username', 'id'))
                    ->native(false),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('role')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('firstname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tier.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('referrer.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
