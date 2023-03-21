<?php
require_once("../autoload.php");

use App\Classes\PlaceList;


if ($_GET){
    $fileName = "places.csv";
    $pathToStorage = $_SERVER["DOCUMENT_ROOT"] . "/App/Storage/";

    $listP = new PlaceList;
    $listP->loadPlacesFromCSV($pathToStorage.$fileName);


    if($_GET["action"] == "getAll"){

        foreach ($listP->places as $place){
            $res[]=$place->name;
        }
        echo(json_encode($res));

    }

    if($_GET["action"] == "getDistance"){
        echo(json_encode($listP->printDistancesFromPlace($_GET["city"])));
    }

}
