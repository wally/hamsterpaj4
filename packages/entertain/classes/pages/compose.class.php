<?php

	class page_entertain_compose extends page
	{
		function url_hook($uri)
		{
			return ($uri == '/entertain/ny') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$this->menu_active = 'entertain_admin_ny';
			if($this->user->exists())
			{
				if(isset($_POST['title']))
				{
					$item = new entertain();
					$item->set(array('type' => $_POST['type']));
					$item->set(array('title' => $_POST['title']));					
					$item->set(array('status' => 'preview'));	
					$item->set(array('uploaded_by' => $this->user->get('id')));		
					$item->save();

					$this->redirect = '/entertain/redigera/' . $item->get('handle');
				}
				$this->content .= template('entertain', 'admin/compose.php');
			}
			else
			{
				$this->content .= 'Du måste vara inloggad för att kunna skicka in objekt i entertain';
			}
		}
	}

?>