<?php

namespace App\Classes;

class Place {
    public $name;
    public $latitude;
    public $longitude;

    public function __construct($name, $latitude, $longitude) {
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}