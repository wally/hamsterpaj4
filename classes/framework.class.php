<?php
	class hp4
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
				return $this->$function($value);
			}
			else
			{
				return $this->$var;
			}
		}
	}

	class page extends hp4
	{
		public $side_modules = array();
		private $user;
		
		function load_side_modules()
		{
			$modules['search'] = new side_module_search();
			$modules['n24'] = new side_module_n24();
			$modules['profile_visitors'] = new side_module_profile_visitors($this->get('user'));
			$modules['statistics'] = new side_module_statistics();
			$modules['forum_posts'] = new side_module_forum_posts();
			$modules['forum_threads'] = new side_module_forum_threads();

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
			$this->menu = new menu;
			$this->menu->data = $menu;
		}
	}
	
	class module extends hp4
	{
		protected $visible = true;
		function execute($page)
		{
			return template('base', 'side_modules/' . $this->template . '.php', array('module' => $this, 'page' => $page));
		}
	}
	
	
	function template($package, $template_handle, $params = null)
	{
		foreach($params as $key => $value)
		{
			if($key != 'template_handle')
			{
				$$key = $value;
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

		tools::debug('<span style="color: red;">Deprecated</span> use of function debug() in ' . $file . ' #' . $backtrace[0]['line'] . ' please use tools::debug() instead');
	}
?>
