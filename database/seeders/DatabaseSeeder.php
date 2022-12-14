<?php

namespace Database\Seeders;

use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Passenger;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\SessionGuard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** @var SessionGuard $auth */
        $auth = Filament::auth();

        /** @var EloquentUserProvider $userProvider */
        $userProvider = $auth->getProvider();

        $userModel = $userProvider->getModel();

        $user = $userModel::create([
            'email'=>'admin@bfo.ch',
            'name'=>'admin@bfo.ch',
            'password'=>Hash::make('admin@bfo.ch'),
        ]);

        $plane747 = Airplane::create([
           'typ'=>'747',
        ]);

        $airportZrh = Airport::create([
           'short_name'=>'ZRH',
           'name'=>'Zürich',
        ]);

        $airportLax = Airport::create([
           'short_name'=>'LAX',
           'name'=>'Los Angeles',
        ]);

        //weitere Dummy Daten
        $bob = Passenger::create([
            'email'=>'bob@gmail.com',
         ]);


        $flightNumber = 255686;
        Flight::create([
           'number'=>$flightNumber,
           'departure_date'=>now(),
           'arrival_date'=>now(),
           'airplane_id'=>$plane747->id,
           'start_airport_id'=>$airportZrh->id,
           'end_airport_id'=>$airportLax->id,
        ]);

         Flight::where('number',$flightNumber)->passengers()->attach($bob);
    }
}
