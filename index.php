<?php
include_once('system/core.cls.php'); // Include CORE class library
$core = new Core; // Load CORE class library as Object
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
<script type="text/javascript" src="./js/geolocate.js"></script>
</head>
<body>

    <div id="main-container" class="container">
        <div class="row-fluid">
            <div id="content-container">
                			
				<form action="forecast.php" method="get">
                <legend>Simple PHP Yahoo Weather Public API</legend>
				<div id="error-box" class="alert alert-error hide">
				What's wrong? You didn't key in anything just now. Try again.
				</div>
				<label for='woeid'>Retrieving your location <strong>WOEID</strong>..</label>
                <input type="text" name="woeid" placeholder="">
                <span class="help-block"><strong>WOEID</strong> for other locations can be found <a href="http://weather.yahoo.com/" target="_blank">here</a>.</span>
                </label>
                <button type="submit" class="btn btn-info">Get Forecast</button>
                </form>
				
            </div>
            
        </div>
    </div>
	
	<script type="text/javascript">
	if (window.location.hash) {
		var hash_value = window.location.hash.replace('#', '');
		if (hash_value == "error")
		{
			$('#error-box').fadeIn('fast');
		}
	}
	</script>
    
</body>
</html>