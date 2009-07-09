<?php
	class page_entertain_edit extends page
	{
		function url_hook($uri)
		{
			return (substr($uri, 0, 20) == '/entertain/redigera/') ? 10 : 0;
		}
		
		function execute($uri)
		{
			if(!$this->user->privilegied('entertain_admin'))
			{
				$this->content .= template('framework/not_privilegied.php');
				return;
			}
			
			$uri_explode = explode('/', $uri);
			
			if($item = entertain::fetch(array('handle' => $uri_explode[3])))
			{
				if($_POST['action'] == 'update')
				{
					$item->update_from_post();
					$item->save();
				}
				
				$dropdown = new html_dropdown();
				$dropdown->set(array('name' => 'category'));
				foreach(entertain::categories() AS $category)
				{
					$dropdown->add_option(array('label' => $category['label'], 'value' => $category['handle']));
				}
				$dropdown->set(array('selected' => $item->get('category')));
				
				$this->content .= $item->render();
				$this->content .= template('entertain', 'admin/edit.php', array('item' => $item, 'dropdown' => $dropdown));
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