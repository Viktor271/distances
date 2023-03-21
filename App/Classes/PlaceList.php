<?php


namespace App\Classes;

use App\Classes\Place;
class PlaceList {
    public $places;

    public function __construct() {
        $this->places = array();
    }

    public function loadPlacesFromCSV($csvFilePath) {
        if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($data[0] == "name"){
                    continue;
                }
                $coor = explode(",", $data[1]);
                $name = $data[0];
                $latitude = $coor[0];
                $longitude = $coor[1];
                $place = new Place($name, $latitude, $longitude);
                $this->places[] = $place;
            }
            fclose($handle);
        }
    }

    public function getPlaceByName($name) {
        foreach ($this->places as $place) {
            if ($place->name == $name) {
                return $place;
            }
        }
        return null;
    }

    public function getDistanceBetweenPlaces($place1, $place2) {
        $earthRadius = 6371; // km
        $lat1 = deg2rad($place1->latitude);
        $lon1 = deg2rad($place1->longitude);
        $lat2 = deg2rad($place2->latitude);
        $lon2 = deg2rad($place2->longitude);
        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;
        $a = sin($deltaLat/2) * sin($deltaLat/2) + cos($lat1) * cos($lat2) * sin($deltaLon/2) * sin($deltaLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earthRadius * $c;
        return $distance;
    }

    public function printDistancesFromPlace($placeName) {
        $res=[];
        $place = $this->getPlaceByName($placeName);
        if ($place == null) {
            throw new RuntimeException("Could not find place: " . $placeName . "\n");
        }
        foreach ($this->places as $otherPlace) {
            if ($otherPlace != $place) {
                $distance = $this->getDistanceBetweenPlaces($place, $otherPlace);
                $res[] = [
                    "name" => $otherPlace->name,
                    "distance" => round($distance,2),
                ];
            }
        }
        $dist = array_column($res, 'distance');
        array_multisort($dist, SORT_ASC, $res);
        return $res;
    }
}