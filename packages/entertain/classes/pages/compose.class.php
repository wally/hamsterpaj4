<?php
	class PageEntertainCompose extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/entertain-admin/ny') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$this->menu_active = 'entertain_admin_ny';
			
			if($this->user->exists())
			{
				if(isset($_POST['title']))
				{
					$item = new Entertain();
					$item->set(array('type' => $_POST['type']));
					$item->set(array('title' => $_POST['title']));				
					$item->set(array('category' => $_POST['category']));		
					$item->set(array('status' => 'preview'));	
					$item->set(array('uploaded_by' => $this->user->get('id')));		
					$item->save();

					$this->redirect = $item->get('edit_url');
				}
				$dropdown = new HTMLDropdown();
				$dropdown->set(array('name' => 'category'));
				foreach( Entertain::categories() AS $category )
				{
					$dropdown->add_option(array('label' => $category['label'], 'value' => $category['handle']));
				}
				$this->content .= template('entertain', 'admin/compose.php', array('dropdown' => $dropdown));
			}
			else
			{
				$this->content .= 'Du måste vara inloggad för att kunna skicka in objekt i entertain';
			}
		}
	}
