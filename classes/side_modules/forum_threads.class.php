<?php
	class side_module_forum_threads extends module
	{
		public $template = 'forum_threads';
		public $id = 'forum_posts';
		function __construct()
		{
			$this->threads = cache::load('latest_forum_threads');
		}
	}

?>