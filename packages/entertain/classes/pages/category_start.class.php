<?php
	class page_entertain_category_start extends page
	{
		function url_hook($uri)
		{
			foreach(array('flash', 'onlinespel', 'bilder', 'filmklipp', 'spel', 'web', 'ascii') as $i)
			{
				if($uri == '/' . $i)
				{
					return 10;
				}
			}
			return 0;
		}
		
		function execute($uri)
		{
			$uri_explode = explode('/', $uri);
			$category = $uri_explode[1];
			
			$this->content = '<h1>Entertain category start!</h1>';
			$items = entertain::fetch(array('category' => $category, 'limit' => 10, 'allow_multiple' => true));
			tools::debug($items);
			$this->content .= entertain::previews($items);

		}
	}

?>