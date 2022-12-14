<?php

namespace App\Filament\Resources\AirplaneResource\Pages;

use App\Filament\Resources\AirplaneResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAirplanes extends ListRecords
{
    protected static string $resource = AirplaneResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
