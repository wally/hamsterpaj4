<?php
	class menu extends page
	{
		function render($page)
		{
			$menu = $this->data;
			
			$submenu = $menu[$page->menu_active]['sub'];
			
			// Sort by priority
			foreach ($menu as $key => $row)
			{
				$priority[$key] = $row['priority'];
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
					tools::debug($key . ' är satt till aktiv');
					$row['active'] = true;
				}
				
				foreach($menu as $key2 => $row2)
				{
					if($row2['parent'] == $key)
					{
						// Kolla om barnet är aktivt
						if($page->menu_active == $key2)
						{
							tools::debug($key2 . ' är nu satt till aktiv');
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
				if($row['active'] == true)
				{
					tools::debug($key . ' är aktiv, vilka submenyer finner vi?');
					foreach($menu as $key2 => $row2)
					{
						if($key == $row2['parent'])
						{
							tools::debug($key2 . ' finns i ' . $key);
							$submenu[$key2] = $row2;
						}
					}
				}
			}

			$out .= template('menu', 'menu.php', array('bigmenu' => $bigmenu, 'submenu' => $submenu));
			
			return $out;
		}
	}
?>