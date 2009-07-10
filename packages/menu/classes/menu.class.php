<?php
	class menu extends page
	{
		function render()
		{
			$menu = $this->data;
			
			// Sort by priority
			foreach ($menu as $key => $row)
			{
				$priority[$key] = $row['priority'];
			}
			array_multisort($priority, SORT_DESC, $menu);

			$out .= template('menu', 'menu.php', array('data' => $menu));
			
			return $out;
		}
	}
?>