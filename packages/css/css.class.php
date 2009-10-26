<?php
	class PageCSS extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/style.css') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$files = Tools::find_files(PATH_PACKAGES,
			    array('extension' => 'css', 'excludes' => array(PATH_PACKAGES . 'hp3css'))
			);
			
			foreach($files AS $file)
			{
				$this->content .= sprintf("/* %s */\n", $file);
				$this->content .= file_get_contents(PATH_PACKAGES . $file);
			}
			
			$this->raw_output = true;
			$this->content_type = 'text/css';
		}
	}
?>
