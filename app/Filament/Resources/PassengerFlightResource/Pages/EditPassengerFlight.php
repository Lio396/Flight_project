<?php

namespace App\Filament\Resources\PassengerFlightResource\Pages;

use App\Filament\Resources\PassengerFlightResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPassengerFlight extends EditRecord
{
    protected static string $resource = PassengerFlightResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
