<?php
	class PageScheduleTest extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/schedule/test') ? 5 : 0;
		}
		
		function execute()
		{
			$this->content = '<h1>Schedule test</h1>';
			
			$schedule = new Schedule('test');
			$release = $schedule->suggest();
			$this->content .= '<p>Scheduling system suggested release at ' . date('Y-m-d H:i:s', $release) . '</p>';
			$schedule->book(array('timestamp' => $release));
			$this->content .= '<p>Booked release at ' . date('Y-m-d H:i:s', $release) . '</p>';			
			
		}
	}
?>