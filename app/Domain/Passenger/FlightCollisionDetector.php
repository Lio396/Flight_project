<?php

namespace App\Domain\Passenger;

use App\Models\Passenger;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;

class FlightCollisionDetector{

    public static function run (Passenger $passenger){

            foreach($passenger->flights as $flight){
                foreach($passenger->flights as $flightControl){
                    if($flight->id === $flightControl->id){
                        continue;
                    }
                    if($flight->arrival_date->lt($flightControl->departure_date)){
                        continue;
                    }
                    if($flight->departure_date->gt($flightControl->arrival_date)){
                        continue;
                    }
                    return "Collision!";
                }
            }
        return "no collision";
    }

}

?>
