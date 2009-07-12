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
				$this->content = template('base', 'notifications/not_found.php', array('header' => 'Item not found', 'information' => 'The sought object could not be found'));
				return;
			}

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
			$comment_list->limit = 10;
			$comment_list->fetch_comments();
			
			$out['big_related'] = $big_related;
			$out['item'] = $item;
			$out['related'] = $related;
			$out['comment_list'] = $comment_list;
			if($this->user->privilegied('entertain_edit'))
			{
				$out['admin'] = template('entertain', 'item_admin_puff.php', array('item' => $item));
			}
			

			switch($item->get('status'))
			{
				case 'removed':
					$this->content .= 'Objektet borttaget';
				break;
				
				case 'queue':
					$this->content .= 'Objektet väntar på att bli godkänt';
				break;
				
				case 'preview':
					$this->content .= 'Objektet är under utveckling';
				break;
				
				case 'scheduled':
					$this->content .= 'Objektet är på väg att bli publicerat';
				break;
				
				default:
					$this->content = template('entertain', 'show_item.php', $out);
				break;
			}
			
		}
	}

?>