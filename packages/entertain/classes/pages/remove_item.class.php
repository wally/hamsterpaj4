<?php
	class page_entertain_remove_item extends page
	{
		function url_hook($uri)
		{
			return (substr($uri, 0, 24) == '/entertain-admin/radera/') ? 10 : 0;
		}
		
		function execute($uri)
		{
			if(!$this->user->privilegied('entertain_admin'))
			{
				$this->content .= template('base', 'notifications/not_privilegied.php');
				return;
			}
			
			$uri_explode = explode('/', $uri);
			
			if($item = entertain::fetch(array('handle' => $uri_explode[3])))
			{
				if($_POST['action'] == 'remove')
				{
					$item->remove();
					
					$this->content = 'Objektet har blivit borttaget';
					return;
				}
			}
			else
			{
				$error['header'] = 'Entertain-objektet finns inte!';
				$error['information'] = 'Objektet "' . $uri_explode[3] . '" finns inte i entertain-databasen.';
				$this->content .= template('framework/notifications/not_found.php', $error);
			}
		}
	}

?>