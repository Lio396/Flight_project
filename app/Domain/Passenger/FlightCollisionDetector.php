<?php

namespace App\Domain\Passenger;

use App\Models\Passenger;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;

class FlightCollisionDetector{

    public static function run (Passenger $passenger){
        //if passenger id = passenger_flight.passenger id -> passenger_flight.flight id -> flight departure und arrival date nachschauen
        //if ($passenger )
        //$pass1 = 1; //muss speter fur alle passengerIds durchgeführt werden
        $passenger_id = $passenger->id;
        $flights = DB::table('passenger_flight')
        ->join('passengers', 'passenger_flight.passenger_id','=', 'passengers.id')
        ->join('flights', 'passenger_flight.flight_id','=', 'flights.id')
        ->select('departure_date','arrival_date','passenger_id', 'flight_id')
       // ->where('passenger_id', '=', $pass1)
        ->get();
        // $dep1 = DB::table('passenger_flight')
        // ->select('departure_date')
        // ->where('flight_id', '=', $pass1)
        // ->get();


        // foreach ( $flights as $passenger_id){
        //     // foreach  FlightID get depDate and arrDate
        //     $departureDate = new DateTime("");
        //     $arrivalDate = new DateTime("");



        // }



        dd($flights);
        return "Collision!";
    }

}

?>
