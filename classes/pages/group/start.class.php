<?php
	class page_group_start extends page
	{
		function url_hook($uri)
		{
			return ($uri == '/grupper') ? 10 : 0;
		}

		function execute()
		{
			$group = group::fetch(array('id' => 4840));
			
			tools::debug($group->entries());
			
			$this->content = template('group/entry_list.php', array('entries' => $group->entries()));
		}
	}

?>