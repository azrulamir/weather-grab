<?php

/*
This class is written to serve as a small library for UI management
purposes. However it was abandond due to such features in not necessary.
Future implemetations might be reconsidered if required.
*/

class Ui
{

	function grab_header()
	{
		$cont = file_get_contents('./ui-templates/header.php');
		return $cont;
	}

	function grab_body_content()
	{	
		$cont = file_get_contents('./ui-templates/content.php');
		return $cont;
	}
	
	function grab_sidebar()
	{	
		$cont = file_get_contents('./ui-templates/sidebar.php');
		return $cont;
	}
	
	function grab_footer()
	{	
		$cont = file_get_contents('./ui-templates/footer.php');
		return $cont;
	}
	
}

?>
