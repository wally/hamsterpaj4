<?php
	class PageJS extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/scripts.js') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$files = Tools::find_files(PATH_PACKAGES, array('extension' => 'js'));
			
			// Files that have to be loaded before the restore_error_handler
			array_unshift($files, 'base/js/jquery-1.3.2.min.js');
			$files = array_unique($files);
			

			foreach($files AS $file)
			{
				$this->content .= file_get_contents(PATH_PACKAGES . $file);
			}
			$this->raw_output = true;
		}
	}