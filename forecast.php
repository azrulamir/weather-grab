<?php
include_once('system/core.cls.php'); // Include CORE class library
include_once('system/api.cls.php'); // Include Yahoo API class library
$core = new Core; // Load CORE class library as Object

$id = $_GET['woeid']; // Assign WOEID GET value to variable 
if (!$id) header( 'Location: '. $core->getConfig('base_url') . '/index.php#error' ) ;

$api = new YahooWeatherAPI; // Load API class library as Object
$api->setWeoid($id); // Set WEOID
$api->getForecastFeed(); // Retreive Forcast Feed

$channel = $api->getChannelElement(); // Assign feed channel element to variable
$forecast = $api->getForecastElement(); // Assign feed forecast element to variable
$geo = $api->getWoeidCoordinate(); // Assign feed geolocation element to variable
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $core->getConfig('site_title'); ?></title>
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
                  <h1>Current Condition</h1>
                  <table class="table">
					<tr class="warning">
                    <td><strong><?php echo date("D, d M Y"); ?></strong></td>
                    <td>&nbsp;</td>
                    </tr>
					<tr>
                    <td>Location</td>
                    <td><?php echo $api->getElementProperties('location:city') . $api->getElementProperties('location:region') . ", " . $api->getElementProperties('location:country'); ?>&nbsp; <a href="https://maps.google.com/maps?q=<?php echo $geo['lat'] . "," . $geo['long']; ?>" target="_blank"><img src="bootstrap/img/glyphicons_060_compass.png" width="20" /></a></td>
                    </tr> 
                  	<tr>
                    <td>Current Condition</td>
                    <td><img width="20" src="http://l.yimg.com/a/i/us/we/52/<?php echo $api->getElementProperties('condition:code'); ?>.gif"  /> <?php echo $api->getElementProperties('condition:text'); ?></td>
                    </tr> 
                    <tr>
                    <td>Temperature</td>
                    <td><?php echo $api->getElementProperties('condition:temp'); ?>&deg; Celcius</td>
                    </tr>
                    <tr>
                    <td>Wind Speed</td>
                    <td><?php echo $api->getElementProperties('wind:speed'); ?> MPH</td>
                    </tr>
					<tr>
                    <td>Last Recorded</td>
                    <td><?php echo $api->getElementProperties('condition:date'); ?></td>
                    </tr> 
					<tr>
                    <td>Humidity</td>
                    <td>
						<div class="progress progress-striped">
							<div class="bar" style="width: <?php echo $api->getElementProperties('atmosphere:humidity'); ?>%;"><?php echo $api->getElementProperties('atmosphere:humidity'); ?>%</div>
						</div>
					</td>
                    </tr> 
                  </table>
				  <h1>Forecast</h1>
				  <table class="table">
					<tr class="warning">
                    <td><strong><?php echo $api->getElementProperties('forecast:day') . ", " . $api->getElementProperties('forecast:date'); ?></strong></td>
                    <td>&nbsp;</td>
                    </tr>
					<tr>
                    <td>Expected Condition</td>
                    <td><img width="20" src="http://l.yimg.com/a/i/us/we/52/<?php echo $api->getElementProperties('forecast:code'); ?>.gif"  /> <?php echo $api->getElementProperties('forecast:text'); ?></td>
                    </tr>
					<tr>
                    <td>Temperature</td>
                    <td><?php echo $api->getElementProperties('forecast:low'); ?>&deg; Celcius - <?php echo $api->getElementProperties('forecast:high'); ?>&deg; Celcius</td>
                    </tr>
					</table>
                </div>
				<button class="btn btn-large btn-danger" type="button" onClick="parent.location = '<?php echo $core->getConfig('base_url'); ?>'">Go Back</button>
				<a class="btn btn-large btn-warning" href="http://weather.yahooapis.com/forecastrss?w=<?php echo $id; ?>&u=c"> Subscribe RSS</a>
            </div>
            
        </div>
    </div>
    
</body>
</html>