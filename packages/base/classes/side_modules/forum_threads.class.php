<?php
	class SideModuleForumThreads extends Module
	{
		public $template = 'forum_threads';
		public $id = 'forum_threads';
		
		function __construct()
		{
			$this->threads = Cache::load('latest_forum_threads');
		}
	}

?>