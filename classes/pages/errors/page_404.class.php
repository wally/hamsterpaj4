<?php
	class Page404 extends page
	{
		function url_hook($url)
		{
			return 1;
		}
		
		function execute($uri)
		{
			$this->content = '<h1>404 not found</h1>';
		}
	}
?>