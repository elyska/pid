<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\OpeningHour;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeneralController extends Controller
{
    public function updateData() {
        $response = Http::get('https://data.pid.cz/pointsOfSale/json/pointsOfSale.json');

        $locations = json_decode($response->body());
        foreach  (array_slice($locations,0, 5) as $item) {
//            Location::create([
//                "id" => $item->id,
//                "type" => $item->type,
//                "name" => $item->name,
//                "address" => $item->address,
//                "lat" => $item->lat,
//                "lon" => $item->lon,
//                "services" => $item->services,
//                "payMethods" => $item->payMethods,
//            ]);
            $location = new Location;

            $location->id = $item->id;
            $location->type = $item->type;
            $location->name = $item->name;
            $location->address = $item->address;
            $location->lat = $item->lat;
            $location->lon = $item->lon;
            $location->services = $item->services;
            $location->payMethods = $item->payMethods;

            $location->save();


            $openingHours = [];
            foreach  ($item->openingHours as $openingHour) {
                $newOpeningHour = OpeningHour::create([
                    'from' => $openingHour->from,
                    'to' => $openingHour->to,
                    'location_id' => $item->id,
                ]);

                $hours = [];
                $timeRanges = explode(",", $openingHour->hours);
                foreach ($timeRanges as $range) {
                    $times = explode("-", $range);
                    $from = new DateTime("1970-01-01 $times[0]:00");
                    $to = new DateTime("1970-01-01 $times[1]:00");
                    $newHour = [
                        'from' => $from,
                        'to' => $to,
                    ];
                    array_push($hours, $newHour);
                }
                $newOpeningHour->hours()->createMany($hours);
            }




//            $location->openingHours()->createMany($openingHours);
//            $openingHours = [];
//            foreach  ($item->openingHours as $openingHour) {
//                $newOpeningHour = new OpeningHour([
//                    'from' => $openingHour->from,
//                    'to' => $openingHour->to,
//                ]);
//                array_push($openingHours, $newOpeningHour);
//            }
//            $location = new Location;
//
//            $location->strid = $item->id;
//            $location->type = $item->type;
//            $location->name = $item->name;
//            $location->address = $item->address;
//            $location->lat = $item->lat;
//            $location->lon = $item->lon;
//            $location->services = $item->services;
//            $location->payMethods = $item->payMethods;
//
//            $location->save();
//            $location->openingHours()->saveMany($openingHours);
        }
    }
}
