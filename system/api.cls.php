<?php

/*
This class is written to serve as a small library to request and
retrieve API results from YAHOO Weather Public API
*/

class API
{	

	private $woeid;
	private $feedResult;
	private $feedChannelElement;
	private $feedForecastElement;
	
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
		$weather_feed = file_get_contents("http://weather.yahooapis.com/forecastrss?w=".$this->getWeoid()."&u=c"); // Assign a variable to hold API request parameters
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
				if($k == 'day') $day = $attr; // Append result to child array for timeline properties
				if($x == 'forecast') { $yw_forecast[$x][$day . ''][$k] = $attr;	}  // Append result to child array for forecast properties
				else { $yw_forecast[$x][$k] = $attr; } // Assign a variable for holding forecast weather condition properties
			}
		}
		return $this->feedForecastElement = $yw_forecast;
	}
	
}

?>