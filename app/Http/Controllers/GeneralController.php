<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\Location;
use App\Models\OpeningHour;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeneralController extends Controller
{
    public function openNow() {
//        $result = Location::with('openingHours.hours')->get();

        $result = Location::with('openingHours.hours')->whereHas('openingHours', function ($query) {
            $currentDayOfWeek = intval(date('N')) - 1;
            $query->where("from", "<=", $currentDayOfWeek)->where("to", ">=", $currentDayOfWeek)->whereHas('hours', function ($query) {
                $now = new DateTime(); //"1970-1-1 23:31"
                $now->setDate(1970, 1, 1); // override the current year
                $query->where("from", "<=", $now)->where("to", ">=", $now);
            });
        })->get();
        dd($result);

        return redirect()->back();
    }
    public function updateData() {
        $response = Http::get('https://data.pid.cz/pointsOfSale/json/pointsOfSale.json');

        $locations = json_decode($response->body());
        Hour::truncate();
        OpeningHour::truncate();
        Location::truncate();
        foreach  (array_slice($locations,0, 50) as $item) {

            $location = new Location;

            $location->strid = $item->id;
            $location->type = $item->type;
            $location->name = $item->name;
            $location->address = $item->address;
            $location->lat = $item->lat;
            $location->lon = $item->lon;
            $location->services = $item->services;
            $location->payMethods = $item->payMethods;

            $location->save();

            foreach  ($item->openingHours as $openingHour) {
                $newOpeningHour = OpeningHour::create([
                    'from' => $openingHour->from,
                    'to' => $openingHour->to,
                    'location_id' => $location->id,
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
        }

        return redirect()->back();
    }
}
