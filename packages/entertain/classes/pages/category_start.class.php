<?php
	class page_entertain_category_start extends page
	{
		function url_hook($uri)
		{
			global $_ENTERTAIN;
			foreach($_ENTERTAIN['categories'] as $handle => $category)
			{
				if($uri == '/' . $handle)
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
			$items = entertain::fetch(array('category' => $category, 'limit' => 10, 'allow_multiple' => true, 'status' => 'released'));
			$this->content .= entertain::previews($items);
			$this->content .= '<br class="clear" /><a href="/entertain/ny">Ladda upp nya objekt</a>';
		}
	}

?>