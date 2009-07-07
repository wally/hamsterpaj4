<?php
	class page_start extends page
	{
		function url_hook($uri)
		{
			return ($uri == '') ? 10 : 0;
		}
		
		function execute()
		{
			$this->content = '<h1>Startsida!</h1>';
		}
	}
?>