<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Filament\Resources\FlightResource\RelationManagers;
use App\Models\Flight;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')->required(),
                Forms\Components\Select::make('airplane_id')->relationship('airplane', 'typ'),
                Forms\Components\Select::make('start_airport_id')->relationship('start', 'short_name'),
                Forms\Components\Select::make('end_airport_id')->relationship('end', 'short_name'),

                Forms\Components\DatePicker::make('departure_date'),
                Forms\Components\DatePicker::make('arrival_date'),
                Forms\Components\Toggle::make('ready'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\TextColumn::make('airplane_id'),
                Tables\Columns\TextColumn::make('start_airport_id'),
                Tables\Columns\TextColumn::make('end_airport_id'),
                Tables\Columns\TextColumn::make('departure_date'),
                Tables\Columns\TextColumn::make('arrival_date'),
                Tables\Columns\TextColumn::make('ready'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PassengersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
