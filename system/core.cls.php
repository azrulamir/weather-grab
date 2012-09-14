<?php

class Core
{
	function get_config()
	{
		$conf = simplexml_load_file('./configuration.xml');
		return $conf;
	}
	
	function base_url()
	{
		$conf = simplexml_load_file('./configuration.xml');
		return $conf->base_url;
	}
}

?>