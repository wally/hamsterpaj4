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
			
			$out .= template('menu', 'menu.php', array('data' => $menu, 'active' => $page->menu_active, 'submenu' => $submenu));
			
			return $out;
		}
	}
?>