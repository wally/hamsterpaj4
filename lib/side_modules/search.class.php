<?php
	class side_module_search extends module
	{
		public $template = 'search';
		public $visitors = 31337;

		function __construct()
		{
			$stats = unserialize(file_get_contents(PATH_CACHE . 'live_stats.phpserialized'));
			debug($stats);
			$this->visitors = $stats['visitors'];
			$this->logged_in = $stats['logged_in'];
			$this->members = $stats['members'];
			$this->pageviews = $stats['pageviews'];
		}
	}

?>