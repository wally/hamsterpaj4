<?php
	class side_module_statistics extends module
	{
		public $template = 'statistics';
		public $visitors = 31337;

		function __construct()
		{
			$stats = unserialize(file_get_contents(PATH_CACHE . 'live_stats.phpserialized'));
			$this->visitors = $stats['visitors'];
			$this->logged_in = $stats['logged_in'];
			$this->members = $stats['members'];
			$this->pageviews = $stats['pageviews'];
		}
	}

?>