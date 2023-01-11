<?php
namespace App\Domain\Passenger;

use App\Models\Passenger;
use Illuminate\Support\Facades\DB;

class FlightCollisionDetector
{
    public static function run(Passenger $passenger)
    {
        $collision = new Collision();

        foreach ($passenger->flights as $flight1) {
            foreach ($passenger->flights as $flight2) {
                if ($flight1->id == $flight2->id) {
                    continue;
                }

                if ($flight1->arrival_date->lt($flight2->departure_date)) {
                    continue;
                }

                if ($flight2->arrival_date->lt($flight1->departure_date)) {
                    continue;
                }
                $collision->colided = true;
                $collision->text = "Its a collision";
                return $collision;

            }
        }
        
        $collision->text = "No collision";
        return $collision;






        //       $passenger_id = $passenger->id;

        //  // $flights = DB::table('passenger_flight')->get();
        //    $passenger_flights = DB::table('passenger_flight')->where('passenger_id', $passenger_id)->get();
        //  // dd($passenger_flights);
        //       $dates = array();

        //      // $Dates = DB::table('users')->where('id', $passenger_id)->value('departure_date', 'arrival_date');
        //     // dd($Dates);
        //     foreach($passenger_flights as $flight){
        //   //      $flight= DB::table('flights')->get();
        //           $flight = DB::table('flights')->where('id', $flight->id)->get(['departure_date', 'arrival_date']);
        //           // array_push($dates, $flight);
        //           // array_push($dates, $flight);
        //        //   dd($flight);
        //        foreach ($flight as $date1) {

        //               dd($flight->departure_date);
        //           foreach ($flight as $date2) {

        //             //  dd($dates);
        //               //dd($date1[1]);
        //               if ($date1->departure_date < $date2->departure_date  ) {
        //                   return "Collision"; }}}

        //       }
        //      //dd($dates[0]);





        //               // if (array_values($date1)[0]< array_values($date2)[0] && array_values($date1)[1]  < array_values($date2)[1] ) {
        //               //     return "Collision"; }}}

        //   //    $flight= DB::table('flight')->where('_id', $passenger_flights->flight_id )->get();


        //   //     return "Collision!";
    }
}
