<?php
	class Page extends HP4
	{
		public $title;
		public $description;
		public $keywords;
		public $side_modules = array();
		public $content_type;
		public $route;
		public $redirect;
		public $raw_output;
		public $menu_active;
		public $content;
		
		// Property:
		//	Page::$page_notification
		// Holds an array of notifications from the previous page view.
		// An element in the array should be the arguments that are passed to <template>
		public $page_notification = array();
		
		public $user;
		
		function load_side_modules()
		{
			$modules['search'] = new SideModuleSearch();
			$modules['n24'] = new SideModuleN24();
			$modules['profile_visitors'] = new SideModuleProfileVisitors($this->get('user'));
			$modules['statistics'] = new SideModuleStatistics();
			$modules['forum_threads'] = new SideModuleForumThreads();
			$modules['forum_posts'] = new SideModuleForumPosts();
			$modules['crew'] = new SideModuleCrew();
			$modules['administration'] = new SideModuleAdministration($this->get('user'));
			
			// Module ordering
			$all_modules = array_keys($modules);
			
			$not_saved = array_diff($all_modules, (array)$this->user->get('module_order'));
			
			$temp = array();
			foreach ( $not_saved as $module )
			{
			    $temp[$module] = $modules[$module];
			}
			
	    		foreach ( (array)$this->user->get('module_order') as $module )
			{
			    $temp[$module] = $modules[$module];
			}
			
			$modules = $temp;
			
			// Module visibility
			$states = (array)$this->user->get('module_states');
			foreach ( $states as $module => $state )
			{
			    if ( isset($modules[$module]) )
			    {
				$modules[$module]->is_closed = ($state == 'close');
			    }
			}
			
			foreach($modules AS $key => $module)
			{
				if ( $module instanceof Module && $module->get('visible') == true)
				{
					$this->side_modules[] = $module;
				}
			}
		}
		
		function logVisit()
		{
			if(rand(0, 73) == 50)
			{
				global $_PDO;
				$query = 'UPDATE pageviews SET views = views + 73 WHERE date = DATE_FORMAT(NOW(),"%Y-%m-%d") LIMIT 1';
				
				if(!$_PDO->query($query))
				{
					$query = 'INSERT INTO pageviews (views, date) VALUES(73, DATE_FORMAT(NOW(),"%Y-%m-%d"))';
					$_PDO->query($query);
				}
			}
		}
		
		function load_menu()
		{
			global $menu;
			$this->menu = new Menu;
			$this->menu->data = $menu;
		}
	}
?>
