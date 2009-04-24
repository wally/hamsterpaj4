<?php
	class page
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
			$this->side_modules['profile_visitors'] = new side_module_profile_visitors($this);
			$this->side_modules['statistics'] = new side_module_statistics();
			$this->side_modules['forum_posts'] = new side_module_forum_posts();
		}
		
		function load_menu()
		{
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
		}
	}
	
	class module
	{
		function execute()
		{
			return template('side_modules/' . $this->template . '.php', $this);
		}
	}
	
	
	function template($template_handle, $page = null)
	{
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
	
	class cache
	{
		public function load($handle)
		{
			$serialized = file_get_contents(PATH_CACHE . $handle . '.phpserialized');
			return unserialize($serialized);
		}
	}
?>