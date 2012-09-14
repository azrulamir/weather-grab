<?php

/*
This class is written to serve as a small library containing
common or basics functions for usage throughout the system.
*/

class Core
{
	function get_config()
	{
		$conf = simplexml_load_file('./configuration.xml'); // Load data from XML config file
		return $conf; // return values for general usage
	}
	
	function base_url()
	{
		$conf = simplexml_load_file('./configuration.xml'); // Load data from XML config file
		return $conf->base_url; // return specific values
	}
}

?>