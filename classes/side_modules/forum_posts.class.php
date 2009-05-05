<?php
	class side_module_forum_posts extends module
	{
		public $template = 'forum_posts';
		public $id = 'forum_posts';
		function __construct()
		{
			$this->threads = cache::load('latest_forum_posts');
		}
	}

?>