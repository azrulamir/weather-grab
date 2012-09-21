<?php
include_once('system/core.cls.php'); // Include CORE class library
include_once('system/api.cls.php'); // Include Yahoo API class library

$core = new Core; // Load CORE class library as Object

$id = $_GET['woeid']; // Assign WOEID GET value to variable 

if (!$id)
{
	header( 'Location: '. $core->getConfig('base_url') . '/index.php#error' ) ;
}

$api = new API; // Load API class library as Object
$api->setWeoid($id); // Set WEOID
$api->getForecastFeed(); // Retreive Forcast Feed

$channel = $api->getChannelElement(); // Assign feed channel element to variable
$forecast = $api->getForecastElement(); // Assign feed forecast element to variable
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
                  <h1>Weather Forecast</h1>
				  <p>&nbsp;</p>
                  <table class="table">
					<tr>
                    <td>Location</td>
                    <td><?php echo $channel['location']['city'] . ", " . $channel['location']['country']; ?></td>
                    </tr> 
                  	<tr>
                    <td>Current Condition</td>
                    <td><img width="20" src="http://l.yimg.com/a/i/us/we/52/<?php echo $forecast['condition']['code']; ?>.gif"  /> <?php echo $forecast['condition']['text']; ?></td>
                    </tr> 
                    <tr>
                    <td>Temperature</td>
                    <td><?php echo $forecast['condition']['temp']; ?> Celcius</td>
                    </tr>
                    <tr>
                    <td>Wind Speed</td>
                    <td><?php echo $channel['wind']['speed']; ?> MPH</td>
                    </tr>
                  </table>
                </div>
				<button class="btn btn-large btn-danger" type="button" onClick="parent.location = '<?php echo $core->getConfig('base_url'); ?>'">Go Back</button>
				<a class="btn btn-large btn-warning" href="http://weather.yahooapis.com/forecastrss?w=<?php echo $woeid; ?>&u=c"> Subscribe RSS</a>
            </div>
            
        </div>
    </div>
    
</body>
</html>