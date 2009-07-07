<?php
	class page_css extends page
	{
		function url_hook($uri)
		{
			return ($uri == '/style.css') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$files = tools::find_files(PATH_PACKAGES, array('extension' => 'css'));
			foreach($files AS $file)
			{
				$this->content .= file_get_contents(PATH_PACKAGES . $file);
			}
			
			$this->raw_output = true;
			$this->content_type = 'text/css';
		}
	}
?>
