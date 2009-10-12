<?php
	class PageTreasurehunt extends page
	{
		function url_hook($url)
		{
			return ($url == '/skattjakten') ? 10 : 0;
		}
		
		function execute()
		{
			$this->content = template('pages/misc/treasurehunt.php');
		}
	}
?>