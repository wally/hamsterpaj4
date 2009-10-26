<?php
	class PageMobileBlogStart extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/mobilblogg') ? 10 : 0;
		}
		
		function execute()
		{
			$this->content = template('pages/social/mobile_blog/start.php');
			$this->content .= template('pages/social/mobile_blog/menu.php', array('user' => $this->user));
			$this->content .= template('pages/social/mobile_blog/form.php');
			
			if(strlen($this->user->get('cell_phone')) < 3)
			{
				$this->content .= template('pages/social/mobile_blog/register_number.php', array('user' => $this->user, 'control_number' => MobileBlog::get_control_number($this->user->username)));
			}
			else
			{
				$this->content .= template('pages/social/mobile_blog/howto.php');
			}
			
			$options['user_id'] = $this->user->get('id');
			$mobile_blogs = MobileBlog::fetch($options);
			
			$entries = array();
			foreach($mobile_blogs as $entry)
			{
				$entry->comment_list = new CommentList();
				$entry->comment_list->user = $this->user;
				$entry->comment_list->item_id = $entry->id;
				$entry->comment_list->type = 'mobile_blog';
				$entry->comment_list->fetch_comments();
				$entries[] = $entry;
			}
			
			$this->content .= '<h2>Dina senaste inlägg</h2>';
			$this->content .= template('pages/social/mobile_blog/list.php', array('entries' => $entries));
		}
	}
?>
