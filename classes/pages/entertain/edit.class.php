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
					$item->set(array('title' => $_POST['title']));
					$item->set(array('category' => $_POST['category']));
					$item->set(array('has_image' => $_POST['has_image']));
					$item->set(array('data' => $_POST));
					$item->save();
				}
				
				$dropdown = new html_dropdown();
				$dropdown->set(array('name' => 'category'));
				foreach(entertain::categories() AS $category)
				{
					$dropdown->add_option(array('label' => $category['label'], 'value' => $category['handle']));
				}
				$dropdown->set(array('selected' => $item->get('category')));
				
				$this->content .= template('pages/entertain/edit.php', array('item' => $item, 'dropdown' => $dropdown));
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