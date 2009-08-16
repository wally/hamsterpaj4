<?php
	
	class page_livesearch_result extends page
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
				$categories = livesearch::search($_POST['queryString']);
				$this->content .= tools::preint_r($items);
			}
			
			$this->content .= template('livesearch', 'result.php', array('categories' => $categories));
			$this->raw_output = true;
		}
	}

?>