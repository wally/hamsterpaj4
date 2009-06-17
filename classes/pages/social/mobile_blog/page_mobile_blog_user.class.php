<?php
	class page_mobile_blog_user extends page
	{
		function url_hook($url)
		{
			return (substr($url, -10) == 'mobilblogg') ? 5 : 0;
		}
		
		function execute()
		{
			$request_uri = split('/', $_SERVER['REQUEST_URI']);
			$username = $request_uri[1];
			
			// Check if user exists
			if(!$user = user::fetch(array('username' => $username)))
			{
				$this->content = template('framework/notifications/not_found.php', 'Användaren hittades inte', 'Är du säker på att du fyllt i rätt namn?');
				return false;
			}
			
			$options['user_id'] = $user->get('id');
			$mobile_blogs = mobile_blog::fetch($options);
			
			$entries = array();
			foreach($mobile_blogs as $entry)
			{
				$entry->comment_list = new comment_list();
				$entry->comment_list->user = $this->user;
				$entry->comment_list->item_id = $entry->id;
				$entry->comment_list->type = 'mobile_blog';
				$entry->comment_list->fetch_comments();
				$entries[] = $entry;
			}
			
			$this->content .= template('pages/social/mobile_blog/user_header.php', array('username' => $user->get('username'), 'user_id' => $user->get('id')));
			
			$this->content .= template('pages/social/mobile_blog/menu.php', array('user' => $this->user));
			
			if($this->user->get('id') == $user->get('id'))
			{
				$this->content .= template('pages/social/mobile_blog/form.php');
				if(strlen($this->user->get('cell_phone')) < 3)
				{
					$this->content .= template('pages/social/mobile_blog/register_number.php', array('user' => $this->user, 'control_number' => mobile_blog::get_control_number($this->user->username)));
				}
				else
				{
					$this->content .= template('pages/social/mobile_blog/howto.php');
				}
			}
			
			if(count($entries) == 0)
			{
				$this->content .= template('framework/notifications/not_found.php', array('header' => 'Inga inlägg hittades', 'information' => 'Den här användaren har inte skrivit något. Hans liv måste vara total-tråkigt, ett kasst ragg med andra ord.'));
				return false;
			}
			
			$this->content .= template('pages/social/mobile_blog/list.php', array('entries' => $entries));
		}
	}
?>