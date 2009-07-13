<?php
	class page_schedule_test extends page
	{
		function url_hook($uri)
		{
			return ($uri == '/schedule/test') ? 5 : 0;
		}
		
		function execute()
		{
			$this->content = 'Schedule test';
			
			$schedule = new schedule('test');
			$release = $schedule->suggest();
			$schedule->book(array('timestamp' => $release));
			
		}
	}
?>