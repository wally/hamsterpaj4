<?php
	class PageViewSchedule extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/admin/schedule') ? 5 : 0;
		}
		
		function execute()
		{
			$this->content = 'Schedule view';
			$this->content .= template('schedule', 'week_view.php');
		}
	}