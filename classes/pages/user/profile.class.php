<?php
	class page_user_profile extends page
	{
		function url_hook($uri)
		{
			return (substr($uri, 0, 10) == '/profiler/') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$this->content = template('user/profile.php');
		}
	}
?>