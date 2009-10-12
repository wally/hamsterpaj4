<?php
	class PageHeartbeat extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/heartbeat') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$this->content = $this->user;
			$this->template = 'system/json.php';
		}
	}
?>