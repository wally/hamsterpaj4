<?php
	
	class PageEntertainSearch extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/soek' ? 10 : 0);
		}
		
		function execute($uri)
		{
			$searchquery = $_GET['searchquery'];
			if(isset($searchquery) && strlen($searchquery) > 0)
			{
					$result = Livesearch::search($searchquery);
			}
			
			$this->content .= template('livesearch', 'search.php', array('searchquery' => $searchquery, 'result' => $result));
		}
	}

?>