<?php
	class PageCSS extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/style.css') ? 10 : 0;
		}
		
		function execute($uri)
		{
			if ( ENVIRONMENT != 'development' && Cache::last_update('css') > (time() - 3600) )
			{
				header('content-type: text/css');
				ECache::output(Cache::get_name('css'));
				exit;
			}
		
			$files = Tools::find_files(PATH_PACKAGES,
			    array('extension' => 'css', 'excludes' => array(PATH_PACKAGES . 'hp3'))
			);
			
			foreach($files AS $file)
			{
				$this->content .= sprintf("/* %s */\n", $file);
				$this->content .= file_get_contents(PATH_PACKAGES . $file);
			}
			
			if ( ENVIRONMENT != 'development' )
			{
			    Cache::save('css', $this->content, false);
			}
			$this->raw_output = true;
			$this->content_type = 'text/css';
		}
	}
?>
