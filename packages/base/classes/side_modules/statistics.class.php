<?php
	class SideModuleStatistics extends Module
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
			
			global $_PDO;
			
			if(Cache::last_update('pageviews') < (time() - 300) )
			{
				$query = 'SELECT views FROM pageviews WHERE date = "' . date('Y-m-d') . '" LIMIT 1';
				$stmt = $_PDO->query($query);
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				$this->pageviews = $data['views'];

				Cache::save('pageviews', $this->pageviews);
			}
			else
			{
				$this->pageviews = Cache::load('pageviews');
			}
		}
	}
?>