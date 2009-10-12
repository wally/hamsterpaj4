<?php
	class PageEntertainCategoryToplist extends Page
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
			$category_label = Entertain::get_category_label($category);
			$this->title = $category_label . 's topplista på Hamsterpaj.net - Mest visningar - Bäst betyg - Roligast';
			
			$most_views = Entertain::fetch(array('category' => $category, 'limit' => 8, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'views DESC'));

			$best_rating = Entertain::fetch(array('category' => $category, 'limit' => 8, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'views DESC'));
			
			// Search tip
			$this->content .= template('base', 'notifications/tip.php', array('text' => 'Vet du om att du kan söka efter underhållning i den blå-vita rutan där det står "Sök underhållning" till höger? -->'));
			
			$this->content .= template('entertain', 'category_toplist.php', array('category_label' => $category_label, 'best_rating' => $best_rating, 'most_views' => $most_views));
		}
	}