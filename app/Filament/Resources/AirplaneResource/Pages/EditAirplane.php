<?php

namespace App\Filament\Resources\AirplaneResource\Pages;

use App\Filament\Resources\AirplaneResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAirplane extends EditRecord
{
    protected static string $resource = AirplaneResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
