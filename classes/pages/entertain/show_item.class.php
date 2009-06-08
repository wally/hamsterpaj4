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
				$this->content = template('framework/notifications/not_found.php', array('header' => 'Item not found', 'information' => 'The sought object could not be found'));
				return;
			}

			// Fetch two items of the same type
			$same_type = entertain::fetch(array('type' => $item->get('type'), 'limit' => 2, 'allow_multiple' => true));

			// Fetch three items with random type
			$random_items = entertain::fetch(array('limit' => 5, 'allow_multiple' => true));
			
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
				$out['admin'] = template('entertain/item_admin_puff.php');
			}
						
			$this->content = template('pages/entertain/show_item.php', $out);
		}
	}

?>