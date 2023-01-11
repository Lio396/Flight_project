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
    const STATUS = array(
        "ready" => "ready",
        "boarding" => "boarding",
        "boarding-finished" => "boarding-finished",
        "flying" => "flying"
    );
    protected static ?string $model = Flight::class;
    var  $globalRecord = 0;
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')->required(),
                Forms\Components\Select::make('airplane_id')->relationship('airplane', 'typ'),
                Forms\Components\Select::make('start_airport_id')->relationship('start', 'short_name'),
                Forms\Components\Select::make('end_airport_id')->relationship('end', 'short_name'),
                Forms\Components\DateTimePicker::make('departure_date'),
                Forms\Components\DateTimePicker::make('arrival_date'),
                Forms\Components\Select::make('status')->options(self::STATUS),])
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SelectColumn::make('airplane_id'),
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\SelectColumn::make('start_airport_id'),
                Tables\Columns\SelectColumn::make('end_airport_id'),
                Tables\Columns\TextColumn::make('departure_date'),
                Tables\Columns\IconColumn::make('arrival_date'),
                Tables\Columns\SelectColumn::make('status')
                    ->options(function (Flight $record){

                        if(!$record->status){
                            return array(
                                "ready" => "ready",
                            );
                        }

                        if($record->status == "ready"){
                            return array(
                                "ready" => "ready",
                                "boarding" => "boarding",
                            );
                        }

                        if($record->status == "boarding"){
                            return array(
                                "boarding" => "boarding",
                                "boarding-finished" => "boarding-finished",
                            );
                        }

                        if($record->status == "boarding-finished"){
                            return array(
                                "boarding-finished" => "boarding-finished",
                                "flying" => "flying"
                            );
                        }
                        return array(
                            "flying" => "flying"
                        );
                        
                    })
                    ,
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
