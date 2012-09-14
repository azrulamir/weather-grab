<?php
include_once('system/api.cls.php');

$lat = $_POST['latitude'];
$lon = $_POST['longtitude'];

$api= new API;
$location = $api->convert_geolocation($lat, $lon);

?>