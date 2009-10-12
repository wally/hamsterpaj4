<?php
	class PageLivesearchResult extends Page
	{
		function url_hook($uri)
		{
			return $uri == '/livesearch/ajax' ? 5 : 0;
		}
		
		function execute($uri)
		{
			global $_PDO;
			
			
			if(isset($_POST['queryString']) && strlen($_POST['queryString']) > 0)
			{		
				$categories = Livesearch::search($_POST['queryString']);
				// This items does not exist?
				//$this->content .= Tools::preint_r($items);
			}
			
			$this->content .= template('livesearch', 'result.php', array('categories' => $categories));
			$this->raw_output = true;
		}
	}

?>