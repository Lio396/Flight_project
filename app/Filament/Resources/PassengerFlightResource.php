<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassengerFlightResource\Pages;
use App\Filament\Resources\PassengerFlightResource\RelationManagers;
use App\Models\PassengerFlight;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PassengerFlightResource extends Resource
{
    protected static ?string $model = PassengerFlight::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('passenger_id')->relationship('passenger', 'email'),
                Forms\Components\Select::make('flight_id')->relationship('flight', 'number'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('passenger.email'),
                Tables\Columns\TextColumn::make('flight.number')->label('Flight Number'),
                Tables\Columns\TextColumn::make('flight.start.short_name')->label('Start airport'),
                Tables\Columns\TextColumn::make('flight.end.short_name')->label('End airport'),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPassengerFlights::route('/'),
            'create' => Pages\CreatePassengerFlight::route('/create'),
            'edit' => Pages\EditPassengerFlight::route('/{record}/edit'),
        ];
    }    
}
