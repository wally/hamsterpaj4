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
			if(is_callable(array($this, $function)))
			{
			    return $this->$function();
				// Why are we calling $function with $value when $value does not exist?
				//return $this->$function($value);
			}
			else
			{
				return $this->$var;
			}
		}
	}

	class Page extends HP4
	{
		public $side_modules = array();
		public $content_type;
		public $route;
		public $redirect;
		public $raw_output;
		public $menu_active;
		public $content;
		
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
	
	function debug($message)
	{
		$backtrace = debug_backtrace();
		$file = substr($backtrace[0]['file'], strrpos($backtrace[0]['file'], '/')+1);

		Tools::debug('<span style="color: red;">Deprecated</span> use of function debug() in ' . $file . ' #' . $backtrace[0]['line'] . ' please use Tools::debug() instead');
	}
?>
