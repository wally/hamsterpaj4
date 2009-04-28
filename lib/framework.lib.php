<?php
	class hp4
	{
		public function set($args)
		{
			foreach($args as $var => $value)
			{
				$function = 'set_' . $var;
				if(is_callable($this->$function))
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
		public $menu = array();
		public $side_modules = array();
		
		function __construct()
		{
			$this->load_menu();
			$this->load_side_modules();
		}
		
		function load_side_modules()
		{
			$this->side_modules['search'] = new side_module_search();
			$this->side_modules['profile_visitors'] = new side_module_profile_visitors(array('page' => $this));
			$this->side_modules['statistics'] = new side_module_statistics();
			$this->side_modules['forum_posts'] = new side_module_forum_posts();
		}
		
		function load_menu()
		{
			debug('Loading menu');
			include(PATH_CONFIGS . 'menu.conf.php');
			$this->menu = $menu;
		}
		
		function execute()
		{
			if(class_exists('page_' . $this->handler))
			{
				
			}
			else
			{
				$this->handler = '404';
				$this->execute();
			}
			$this->load_menu();
		}
	}
	
	class module extends hp4
	{
		function execute($page)
		{
			return template('side_modules/' . $this->template . '.php', array('module' => $this, 'page' => $page));
		}
	}
	
	
	function template($template_handle, $params = null)
	{
		foreach($params as $key => $value)
		{
			if($key != 'template_handle')
			{
				$$key = $value;
			}
		}

		ob_start();
		include(PATH_TEMPLATES . $template_handle);
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	function debug($message)
	{
		global $_DEBUG;
		$backtrace = debug_backtrace();
		$file = substr($backtrace[0]['file'], strrpos($backtrace[0]['file'], '/')+1);
		$message = (is_array($message)) ? '<pre>' . print_r($message, true) . '</pre>' : $message;
		$_DEBUG[] = array('title' => $file . ' #' . $backtrace[0]['line'], 'text' => $message);
	}
?>
