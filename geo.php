<?php
include_once('system/core.cls.php'); 
include_once('system/api.cls.php');

$lat = $_POST['latitude'];
$lon = $_POST['longtitude'];

$geo = new YahooGeolocation;
$geo->setCoordinate($lat, $lon);

echo $geo->getLocationWoeid();
?>