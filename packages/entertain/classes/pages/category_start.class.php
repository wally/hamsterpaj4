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
			$category_label = entertain::get_category_label($category);
			
			$latest = entertain::fetch(array('category' => $category, 'limit' => 1, 'status' => 'released', 'order_by' => 'published_at DESC'));
			
			$new_items = entertain::fetch(array('category' => $category, 'limit' => 12, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'published_at DESC'));
			shuffle($new_items);
			$new_items = array_splice($new_items, 0, 4);

			$popular_items = entertain::fetch(array('category' => $category, 'limit' => 12, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'views DESC'));
			shuffle($popular_items);
			$popular_items = array_splice($popular_items, 0, 4);
			
			$this->content .= template('entertain', 'category_start.php', array('category_label' => $category_label, 'new_items' => $new_items, 'latest' => $latest, 'popular_items' => $popular_items));
		}
	}

?>
