<?php

	class page_entertain_compose extends page
	{
		function url_hook($uri)
		{
			return ($uri == '/entertain/compose') ? 10 : 0;
		}
		
		function execute($uri)
		{
			if($this->user->privilegied('entertain_add'))
			{
				if($_POST['action'] == 'create')
				{
					$item = new entertain();
					$item->set(array('type' => $_POST['type']));
					$item->set(array('category' => $_POST['category']));
					$item->set(array('title' => $_POST['title']));
					
					switch($_POST['type'])
					{
						case 'html':
							$item->set(array('data' => html_entity_decode($_POST['data'])));
							break;
						case 'url':
							$item->set(array('data' => $_POST['data']));				
							break;
						case 'iframe':
							$item->set(array('data' => html_entity_decode($_POST['data'])));
							break;
						case 'web':
							$item->set(array('data' => html_entity_decode($_POST['data'])));
							break;
					}
					
					$item->set(array('data' => $_POST['data']));
					$item->save();
					
					$this->content = '<h1>Creeeeeate!</h1>';
				}
				if($_POST['action'] == 'update')
				{
					
				}				
				
				$this->content .= template('entertain/admin_form.php');
			}
			else
			{
				$this->content .= template('framework/not_privilegied.php');
			}
		}
	}

?>