<?php
include_once('system/core.cls.php');
include_once('system/api.cls.php');

$core = new Core;
$api = new API;

$conf = $core->get_config();

$woeid = $_GET['woeid'];
$woeidinfo = $api->get_weather($woeid, 'channel');
$forecast = $api->get_weather($woeid, 'forecast');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $conf->site_title; ?></title>
<link href="./css/style.css" type="text/css" rel="stylesheet">
<link href="./bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="./bootstrap/css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery-1.7.2.min.js"></script>
</head>
<body>

    <div id="main-container" class="container">
        <div class="row-fluid">
         
            <div id="content-container">
                <div class="hero-unit">
                  <h1>Weather Forecast</h1>
                  <p><?php echo $woeidinfo['location']['city'] . ", " . $woeidinfo['location']['country']; ?></p>
                  <p></p>
                
                  <table class="table">
                  	<tr>
                    <td>Condition</td>
                    <td><?php echo $forecast['condition']['text']; ?></td>
                    </tr> 
                    <tr>
                    <td>Temperature</td>
                    <td><?php echo $forecast['condition']['temp']; ?> Celcius</td>
                    </tr>
                    <tr>
                    <td>Wind Speed</td>
                    <td><?php echo $woeidinfo['wind']['speed']; ?> MPH</td>
                    </tr>
                  </table>
                </div>
				<button class="btn btn-large btn-primary" type="button" onClick="history.back()">Go Back</button>
            </div>
            
        </div>
    </div>
    
</body>
</html>