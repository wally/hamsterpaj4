<?php

	class page_entertain_compose extends page
	{
		function url_hook($uri)
		{
			return ($uri == '/entertain/ny') ? 10 : 0;
		}
		
		function execute($uri)
		{
			if($this->user->privilegied('entertain_admin'))
			{
				if(isset($_POST['title']))
				{
					$item = new entertain();
					$item->set(array('type' => $_POST['type']));
					$item->set(array('title' => $_POST['title']));					
					$item->save();
					
					$this->redirect = '/entertain/redigera/' . $item->get('handle');
				}
				$this->content .= template('entertain', 'admin/compose.php');
			}
			else
			{
				$this->content .= template('base', 'notifications/not_privilegied.php');
			}
		}
	}

?>