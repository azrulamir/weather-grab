<?php

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
