<?php
	
	class page_entertain_item extends page
	{
		function url_hook($uri)
		{
			foreach(array('flash', 'onlinespel', 'bilder', 'filmklipp', 'spel', 'webb', 'ascii') as $i)
			{
				if(substr($uri, 1, strlen($i)) == $i && strlen($uri) > strlen($i)+2)
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
				$this->content = template(NULL, 'framework/notifications/not_found.php', array('header' => 'Item not found', 'information' => 'The sought object could not be found'));
				return;
			}

			// Fetch two items of the same type
			$same_type = entertain::fetch(array('type' => $item->get('type'), 'limit' => 2, 'allow_multiple' => true, 'status' => 'released'));

			// Fetch three items with random type
			$random_items = entertain::fetch(array('limit' => 5, 'allow_multiple' => true, 'status' => 'released'));
			
			$related = array_merge($same_type, $random_items);
			
			$comment_list = new comment_list;
			$comment_list->user = $this->user;
			$comment_list->type = 'entertain';
			$comment_list->item_id = $item->get('id');
			$comment_list->limit = 10;
			$comment_list->fetch_comments();
			
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