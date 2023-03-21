<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Full Stack Developer practical test</title>
    <link href="index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="/App/js/script.js"></script>
</head>


<?php
require_once(__DIR__ . "/autoload.php");

use App\Classes\PlaceList;

$fileName = "places.csv";
$pathToStorage = $_SERVER["DOCUMENT_ROOT"] . "/App/Storage/";

$listP = new PlaceList;

$listP->loadPlacesFromCSV($pathToStorage.$fileName);
?>

<body><br><br><br>

<div class="container">
    <div class="row">
        <div class="col-sm-2"><div id="mySlider"></div>
            <label for="speed">Select a speed</label>
            <select name="speed" id="speed">
                <option>Slower</option>
                <option>Slow</option>
                <option selected="selected">Medium</option>
                <option>Fast</option>
                <option>Faster</option>
            </select>
        </div>
        <div class="col-sm-4">

            <div id="slider">
                <div id="custom-handle" class="ui-slider-handle"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <table class="table" id="my-table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Distance (km)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listP->printDistancesFromPlace("Ustica") as $plase):?>
                    <tr>
                        <td><?=$plase['name']?></td>
                        <td><?=$plase['distance']?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
