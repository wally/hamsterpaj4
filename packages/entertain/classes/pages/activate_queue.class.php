<?php
	class PageEntertainEctivateQueue extends Page
	{
		public static function url_hook($uri)
		{
			return (substr($uri, 0, 25) == '/entertain-admin/aktivera') ? 5 : 0;
		}
		
		function execute($uri)
		{
			$this->menu_active = 'entertain_admin_aktivera';
			// Fetch items which is in queue
			$items = Entertain::fetch(array('limit' => 3000, 'allow_multiple' => true, 'status' => 'queue'));

			$this->content = template('entertain', 'admin/activate_queue.php', array('items' => $items));
		}
	}