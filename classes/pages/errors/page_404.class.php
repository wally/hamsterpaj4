<?php
	class page_404 extends page
	{
		function url_hook($url)
		{
			return 1;
		}
		function execute()
		{
			$this->content = '<h1>404 not found</h1>';
		}
	}
?>