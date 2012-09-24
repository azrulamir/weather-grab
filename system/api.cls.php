<?php

/*
This class is written to serve as a small library to request and
retrieve results from YAHOO Place Finder API.
*/

class YahooGeolocation
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
		
		$URI_request = 'http://where.yahooapis.com/geocode?location='.$this->getCoordinate('lat').','.$this->getCoordinate('lon').'&gflags=R&appid='.$core->getConfig('yahoo_appId');
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

/*
This class is written to serve as a small library to request and
retrieve API results from YAHOO Weather Public API
*/

class YahooWeatherAPI
{	

	private $woeid;
	private $feedResult;
	private $feedChannelElement;
	private $feedForecastElement;
	private $woeidCoordinate;
	
	public function setWeoid($id)
	{
		return $this->woeid = $id;
	}
	
	public function getWeoid()
	{
		return $this->woeid;
	}
	
	public function getForecastFeed()
	{
		$URI_request = "http://weather.yahooapis.com/forecastrss?w=".$this->getWeoid()."&u=c";
		$weather_feed = file_get_contents($URI_request); // Assign a variable to hold API request parameters
		if(!$weather_feed) die('weather failed, check feed URL'); // Check for issue with API feed. Return error shall no result returned.
		return $this->feedResult = simplexml_load_string($weather_feed); // Load XML feed via simpleXML method.
	}
	
	public function getChannelElement()
	{
		$channel_yweather = $this->feedResult->channel->children("http://xml.weather.yahoo.com/ns/rss/1.0"); // Pinpoint the correct node for data retrieval  
		
		// Convert API return result from XML into an array format via looping method 
		foreach($channel_yweather as $x => $channel_item)
		{
			foreach($channel_item->attributes() as $k => $attr) 
			{
				$yw_channel[$x][$k] = $attr; // Assign a variable for holding forecast channel properties
			}
		}
		return $this->feedChannelElement = $yw_channel;
	}
	
	public function getForecastElement()
	{
		$item_yweather = $this->feedResult->channel->item->children("http://xml.weather.yahoo.com/ns/rss/1.0"); // Pinpoint the correct node for data retrieval  
		
		// Convert API return result from XML into an array format via looping method 
		foreach($item_yweather as $x => $yw_item)
		{
			foreach($yw_item->attributes() as $k => $attr)
			{
				$yw_forecast[$x][$k] = $attr; // Assign a variable for holding forecast item properties
			}
		}
		return $this->feedForecastElement = $yw_forecast;
	}
	
	public function getWoeidCoordinate()
	{
		$geo_yweather = $this->feedResult->channel->item->children("geo", TRUE);  // Pinpoint the correct node for data retrieval  

		// Convert API return result from XML into an array format via looping method 
		foreach($geo_yweather as $x => $yw_item)
		{
			$yw_geo[$x] = $yw_item;
		}
		return $this->woeidCoordinate = $yw_geo;
	}
	
	public function getElementProperties($propType) // $propType format is 'arraykey:arrayvalue'
	{
		$channel = $this->feedChannelElement;
		$forecast = $this->feedForecastElement;
		
		$propTypeSplit = split(":", $propType);
		
		$lookup_channel_array = $channel[$propTypeSplit[0]][$propTypeSplit[1]];
		if (!$lookup_channel_array)
		{
			$lookup_forecast_array = $forecast[$propTypeSplit[0]][$propTypeSplit[1]];
			return $lookup_forecast_array;
		}
		else
		{
			return $lookup_channel_array;
		}
	}
	
}

?>