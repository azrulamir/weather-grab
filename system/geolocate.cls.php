<?php

/*
This class is written to serve as a small library for handling Geolocation
positioning. 
*/
include_once('system/core.cls.php'); 

class Geolocation
{	
	
	private $posCoordinate;
	private $geoFeed;
	private $woeid;
	
	public function setCoordinate($latPos, $lonPos)
	{
		$locCoordinate = array(
			'lat' => $latPos,
			'lon' => $lonPos
		);
		return $this->posCoordinate = $locCoordinate;
	}
	
	public function getCoordinate($type)
	{
		$coor_val = $this->posCoordinate;
		return $coor_val[$type];
	}
	
	public function getLocationFeed()
	{
		$core = new Core;
		
		$URI_request = 'http://where.yahooapis.com/geocode?location='.$this->getCoordinate('lat').','.$this->getCoordinate('lon').'&gflags=R&appid='.$core->getConfig('yahoo_AppId');
		$geo_api = file_get_contents($URI_request);
		if(!$geo_api) die('weather failed, check feed URL');
		return $this->geoFeed = simplexml_load_string($geo_api);
	}
	
	public function getLocationWoeid()
	{
		$this->getLocationFeed();
		return $this->woeid = $this->geoFeed->Result->woeid;
	}
}

?>