<?php
	class PageCSS extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/style.css') ? 10 : 0;
		}
		
		function execute($uri)
		{
			if(Cache::last_update('css') > (time() - 600))
			{
				$this->content = Cache::load('css');
				$this->raw_output = true;
				$this->content_type = 'text/css';
				return true;
			}
		
			$files = Tools::find_files(PATH_PACKAGES,
			    array('extension' => 'css', 'excludes' => array(PATH_PACKAGES . 'hp3css'))
			);
			
			foreach($files AS $file)
			{
				$this->content .= sprintf("/* %s */\n", $file);
				$this->content .= file_get_contents(PATH_PACKAGES . $file);
			}
			
			Cache::save('css', $this->content);
			$this->raw_output = true;
			$this->content_type = 'text/css';
		}
	}
?>
