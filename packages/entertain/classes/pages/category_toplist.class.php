<?php
	class page_entertain_category_toplist extends page
	{
		function url_hook($uri)
		{
			global $_ENTERTAIN;
			foreach($_ENTERTAIN['categories'] as $handle => $category)
			{
				if($uri == '/' . $handle . '/topplista')
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
			$this->menu_active = $category . '_topplista';
			$category_label = entertain::get_category_label($category);
			
			$most_views = entertain::fetch(array('category' => $category, 'limit' => 8, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'views DESC'));

			$best_rating = entertain::fetch(array('category' => $category, 'limit' => 8, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'views DESC'));
			
			$this->content .= template('entertain', 'category_toplist.php', array('category_label' => $category_label, 'best_rating' => $best_rating, 'most_views' => $most_views));
		}
	}

?>