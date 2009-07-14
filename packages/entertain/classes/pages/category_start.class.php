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
			$this->menu_active = $category;
			
			$items = entertain::fetch(array('category' => $category, 'limit' => 10, 'allow_multiple' => true, 'status' => 'released'));
			$this->content .= template('entertain', 'category_start.php', array('items' => $items));
		}
	}

?>
