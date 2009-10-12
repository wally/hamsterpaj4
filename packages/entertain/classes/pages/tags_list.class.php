<?php
	class PageEntertainTagsList extends Page
	{
		function url_hook($uri)
		{
			global $_ENTERTAIN;
			$uri_explode = explode('/', $uri);
			
			if ( count($uri_explode) >= 3 )
			{
			    foreach($_ENTERTAIN['categories'] as $handle => $category)
			    {
				    if($uri_explode[1] == $handle && $uri_explode[2] == 'taggar')
				    {
					    return 15;
				    }
			    }
			}
			
			return 0;
		}
		
		function execute($uri)
		{
			$uri_explode = explode('/', $uri);
			
			if( Menu::exists($uri_explode[1] . '_' . $uri_explode[3]) )
			{
				$this->menu_active = $uri_explode[1] . '_' . $uri_explode[3];
			}
			else
			{
				$this->menu_active = $uri_explode[1];
			}
			
			if(!$tags = Tag::fetch(array('handle' => $uri_explode[3])))
			{
				$this->content .= 'Den här taggen finns inte';
				return;
			}
			
			
			foreach( $tags as $tag )
			{
				$tag_title = $tag->title;
				$items_id[] = $tag->item_id;
			}
			
			Tools::debug($items_id);
			
			// Search tip
			$this->content .= template('base', 'notifications/tip.php', array('text' => 'Vet du om att du kan söka efter underhållning i den blå-vita rutan där det står "Sök underhållning" till höger? -->'));
			
			$items = Entertain::fetch(array('ids' => $items_id, 'allow_multiple' => true, 'status' => 'released', 'category' => $uri_explode[1]));
			$this->content .= '<h1>Föremål med taggen: ' . $tag_title . '</h1>';
			$this->content .= Entertain::item_list($items);
		}
	}
?>