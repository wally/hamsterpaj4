<?php
	class SideModuleForumPosts extends Module
	{
		public $template = 'forum_posts';
		public $id = 'forum_posts';
		
		function __construct()
		{
			$this->threads = Cache::load('latest_forum_posts');
		}
	}

?>