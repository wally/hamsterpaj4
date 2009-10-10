<?php
	class side_module_statistics extends module
	{
		public $template = 'statistics';
		public $visitors = 31337;
		public $id = 'statistics';

		function __construct()
		{
			$stats = unserialize(file_get_contents(PATH_CACHE . 'live_stats.phpserialized'));
			$this->visitors = $stats['visitors'];
			$this->logged_in = $stats['logged_in'];
			$this->members = $stats['members'];
			$this->pageviews = (isset($stats['pageviews'])) ? $stats['pageviews'] : false; // Does this even exist?
		}
	}

?>