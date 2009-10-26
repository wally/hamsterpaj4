<?php
	class HP4
	{
		public function set($args)
		{
			foreach($args as $var => $value)
			{
				$function = 'set_' . $var;
				if(is_callable(array($this, $function)))
				{
					$this->$function($value);
				}
				else
				{
					$this->$var = $value;
				}
			}
		}
	
		public function get($var)
		{
			$function = 'get_' . $var;
			if( is_callable(array($this, $function)) )
			{
				return $this->$function();
			}
			else
			{
				return $this->$var;
			}
		}
	}

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
		
		// Property: Page::$page_notification
		// Holds an array of notifications from the previous page view.
		// An element in the array should be the arguments that are passed to <template>
		public $page_notification = array();
		
		private $user;
		
		function load_side_modules()
		{
			$modules['search'] = new SideModuleSearch();
			$modules['n24'] = new SideModuleN24();
			$modules['profile_visitors'] = new SideModuleProfileVisitors($this->get('user'));
			$modules['statistics'] = new SideModuleStatistics();
			$modules['forum_posts'] = new SideModuleForumPosts();
			$modules['forum_threads'] = new SideModuleForumThreads();

			foreach($modules AS $key => $module)
			{
				if($module->get('visible') == true)
				{
					$this->side_modules[] = $module;
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
	
	class Module extends HP4
	{
		public $is_sortable = true;
		protected $visible = true;
		
		function execute($page)
		{
			return template('base', 'side_modules/' . $this->template . '.php', array('module' => $this, 'page' => $page));
		}
	}
	
	function template($package, $template_handle, $params = null)
	{
		if ( is_array($params) )
		{
		    extract($params);
		}
		else
		{
		    foreach((array)$params as $key => $value)
		    {
			    if($key != 'template_handle')
			    {
				    $$key = $value;
			    }
		    }
		}
		
		ob_start();
		if($package == null)
		{
			include(PATH_TEMPLATES . $template_handle);
		}
		else
		{
			include(PATH_PACKAGES . $package . '/templates/' . $template_handle);
		}
		$html = ob_get_contents();
		ob_end_clean();
		
		return $html;
	}
?>
