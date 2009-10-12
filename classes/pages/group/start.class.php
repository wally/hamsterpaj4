<?php
	class PageGroupStart extends page
	{
		function url_hook($uri)
		{
			return ($uri == '/grupper') ? 10 : 0;
		}

		function execute()
		{
			$group = Group::fetch(array('id' => 4840));
			
			Tools::debug($group->entries());
			
			$this->content = template('group/entry_list.php', array('entries' => $group->entries()));
		}
	}

?>