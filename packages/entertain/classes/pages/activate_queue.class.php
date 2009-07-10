<?php
	
	class page_entertain_activate_queue extends page
	{
		function url_hook($uri)
		{
			tools::debug(substr($uri, 0, 19));
			return (substr($uri, 0, 19) == '/entertain/aktivera') ? 5 : 0;
		}
		
		function execute($uri)
		{
			// Fetch items which is in queue
			$items = entertain::fetch(array('limit' => 20, 'allow_multiple' => true, 'status' => 'queue'));

			$this->content = template('entertain', 'admin/activate_queue.php', array('items' => $items));
		}
	}

?>