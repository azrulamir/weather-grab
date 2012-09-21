<?php

/*
This class is written to serve as a small library containing
common or basics functions for usage throughout the system.
*/

class Core
{

	private $config;

	public function getConfig($type)
	{
		$conf = simplexml_load_file('./configuration.xml'); // Load data from XML config file
		$conf_value = $conf->$type;
		return $this->config = $conf_value; // return values for general usage
	}
	
}

?>