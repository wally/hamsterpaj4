<?php
	class Menu extends Page
	{
		function exists($menu_item)
		{
			global $menu;
			return isset($menu[$menu_item]);
		}
		
		function render($page)
		{
			$menu = $this->data;
			
			$submenu = (isset($menu[$page->menu_active]['sub']) ? $menu[$page->menu_active]['sub'] : null);
			
			$priority = array();
			// Sort by priority
			foreach ($menu as $key => $row)
			{
				$priority[$key] = isset($row['priority']) ? $row['priority'] : null;
			}
			array_multisort($priority, SORT_DESC, $menu);
			
			// Sätt rätt menyval till aktivt
			foreach($menu as $key => $row)
			{
				if(isset($row['parent']))
				{
					break;
				}
				
				// Kolla om menyvalet är aktivt
				if($key == $page->menu_active)
				{
					Tools::debug($key . ' är satt till aktiv');
					$row['active'] = true;
				}
				
				foreach($menu as $key2 => $row2)
				{
					if(isset($row2['parent']) && $row2['parent'] == $key)
					{
						// Kolla om barnet är aktivt
						if($page->menu_active == $key2)
						{
							Tools::debug($key2 . ' är nu satt till aktiv');
							// Sätt föräldern till aktiv
							$row['active'] = true;
							// Sätt ungen till aktiv
							$menu[$key2]['active'] = true;
							
						}
					}
				}
				
				// Spara ändringarna
				$bigmenu[$key] = $row;
			}

			// Sök upp vilka poster som ska vara i undermenyn
			foreach($bigmenu as $key => $row)
			{
				// Om det här är den aktiva menyn, hämta submeny
				if(isset($row['active']) && $row['active'] == true)
				{
					Tools::debug($key . ' är aktiv, vilka submenyer finner vi?');
					foreach($menu as $key2 => $row2)
					{
						if(isset($row2['parent']) && $key == $row2['parent'])
						{
							Tools::debug($key2 . ' finns i ' . $key);
							$submenu[$key2] = $row2;
						}
					}
				}
			}

			$out = template('menu', 'menu.php', array('bigmenu' => $bigmenu, 'submenu' => $submenu));
			
			return $out;
		}
	}
?>