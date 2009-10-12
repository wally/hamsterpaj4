<?php
	class PageAlphabetOnTime extends Page
	{
		function url_hook($url)
		{
			return ($url == '/alfabetet-paa-tid') ? 10 : 0;
		}
		
		function execute()
		{
			$this->menu_active = 'alfabetet-paa-tid';
			$this->content = template('alphabet_on_time', 'alphabet_on_time.php');
		}
	}
?>