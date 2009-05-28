<?php
	class page_heartbeat extends page
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