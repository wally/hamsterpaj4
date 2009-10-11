<?php
	
	class page_entertain_item extends page
	{
		function url_hook($uri)
		{
			global $_ENTERTAIN;
			
			foreach($_ENTERTAIN['categories'] as $handle => $category)
			{
				if(substr($uri, 1, strlen($handle)) == $handle && strlen($uri) > strlen($handle)+2)
				{
					return 10;
				}
			}
			return 0;
		}
		
		function execute($uri)
		{
			
			
			$uri_explode = explode('/', $uri);
			if(!$item = entertain::fetch(array('handle' => $uri_explode[2])))
			{
				$searchquery = $uri_explode[2];
				
				$searchquery = str_replace('_', ' ', $searchquery);
				
				
				$this->content = template('base', 'notifications/not_found.php', array('header' => 'Föremålet hittades inte', 'information' => '<a href="/soek?searchquery=' . $searchquery . '" />Klicka här för att söka efter det istället</a>'));
				return;
			}
			
			$this->menu_active = $item->get('category');
			// $this->clickheat = 'Entertain-' . $item->get('category');
			
			// Update number of views
			$item->update_views();
			
			// Fetch items with tags matching
			$matching_tag_items = entertain::fetch(array('category' => $item->get('category'), 'limit' => 8, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'RAND()'));
			$matching_tag_items1 = array_slice($matching_tag_items, 0, 4);
			$matching_tag_items2 = array_splice($matching_tag_items, 5, 8);
			$matching_tag_items2 = entertain::fetch(array('category' => $item->get('category'), 'limit' => 4, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'RAND()'));

			// Fetch two items of the same category
			$same_category = entertain::fetch(array('category' => $item->get('category'), 'limit' => 2, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'RAND()'));

			// Fetch three items with random type
			$random_items = entertain::fetch(array('limit' => 2, 'allow_multiple' => true, 'status' => 'released', 'order_by' => 'RAND()'));
			
			$big_related = entertain::fetch(array('limit' => 1,  'status' => 'released', 'order_by' => 'RAND()'));
			
			$related = array_merge($same_category, $random_items);
			
			$comment_list = new comment_list;
			$comment_list->user = $this->user;
			$comment_list->type = 'entertain';
			$comment_list->item_id = $item->get('id');
			$comment_list->limit = 3;
			$comment_list->fetch_comments();
			
			$out['big_related'] = $big_related;
			$out['item'] = $item;
			$out['related'] = $related;
			$out['matching_tag_items1'] = $matching_tag_items1;
			$out['matching_tag_items2'] = $matching_tag_items2;
			$out['comment_list'] = $comment_list;
			if($this->user->privilegied('entertain_edit'))
			{
				$out['admin'] = template('entertain', 'item_admin_puff.php', array('item' => $item));
			}
			
			// Search tip
			$this->content .= template('base', 'notifications/tip.php', array('text' => 'Vet du om att du kan söka efter underhållning i den blå-vita rutan där det står "Sök underhållning" till höger? -->'));
			
			$this->title = $item->get('title') . ' på Hamsterpaj.net - ' . entertain::get_category_label($item->get('category'));
			foreach($item->tags as $tag)
			{
				$this->title .= ' - ' . $tag->title;
			}
			
			switch($item->get('status'))
			{
				case 'removed':
					$this->content .= 'Objektet borttaget';
					$this->user->privilegied('entertain_admin') ? $this->content .= ' <a href="' . $item->get('edit_url') . '">Redigera</a>' : '';
				break;
				
				case 'queue':
					$this->content .= 'Objektet väntar på att bli godkänt.';
					$this->user->privilegied('entertain_admin') ? $this->content .= ' <a href="' . $item->get('edit_url') . '">Redigera</a>' : '';
				break;
				
				case 'preview':
					$this->content .= 'Objektet är under utveckling';
					$this->user->privilegied('entertain_admin') ? $this->content .= ' <a href="' . $item->get('edit_url') . '">Redigera</a>' : '';
				break;
				
				case 'scheduled':
					$this->content .= 'Objektet är på väg att bli publicerat';
					$this->user->privilegied('entertain_admin') ? $this->content .= ' <a href="' . $item->get('edit_url') . '">Redigera</a>' : '';
				break;
				
				default:
					$this->content .= template('entertain', 'show_item.php', $out);
				break;
			}
			
		}
	}

?>
