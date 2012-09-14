<?php
include_once('system/core.cls.php');
include_once('system/api.cls.php');

$core = new Core;
$conf = $core->get_config();
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
                <form action="forecast.php" method="get">
                <legend>Simple PHP Yahoo Weather Public API</legend>
                <label>Yahoo WOEID</label>
                <input type="text" name="woeid">
                <span class="help-block">The WOEID for your location can be found <a href="http://weather.yahoo.com/" target="_blank">here</a></span>
                </label>
                <button type="submit" class="btn btn-primary">Get Forecast</button>
                </form>
            </div>
            
        </div>
    </div>
    
</body>
</html>