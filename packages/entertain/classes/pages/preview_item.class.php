<?php
	class page_entertain_preview_item extends page
	{
		function url_hook($uri)
		{
			return (substr($uri, 0, 34) == '/entertain-admin/forhandsgranska/') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$this->menu_active = 'entertain_admin';
			$uri_explode = explode('/', $uri);
			
			if($item = entertain::fetch(array('handle' => $uri_explode[3])))
			{
				// Can I preview the object?
				if(($item->get('uploaded_by') == $this->user->get('id') && $item->get('status') == 'preview') || $this->user->privilegied('entertain_admin'))
				{
					$this->content .= template('entertain', 'admin/preview_item.php', array('item' => $item));
				}
				else
				{
					$this->content .= template('base', 'notifications/not_privilegied.php');
					return;
				}
			}
			else
			{
				$error['header'] = 'Entertain-objektet finns inte!';
				$error['information'] = 'Objektet "' . $uri_explode[3] . '" finns inte i entertain-databasen.';
				$this->content .= template(NULL, 'framework/notifications/not_found.php', $error);
			}
		}
	}
?>