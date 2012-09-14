<?php
include_once('system/core.cls.php'); // Include CORE class library
include_once('system/api.cls.php'); // Include Yahoo API class library

$core = new Core; // Load CORE class library as Object
$api = new API; // Load Yahoo API class library as Object

$conf = $core->get_config(); // Assign variable for calling CORE library properties

$woeid = $_GET['woeid']; // Assign WOEID GET value to variable 

// Assign variables to hold Yahoo API library request properties
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
				<button class="btn btn-large btn-danger" type="button" onClick="history.back()">Go Back</button>
            </div>
            
        </div>
    </div>
    
</body>
</html>