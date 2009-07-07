<?php
	class page_js extends page
	{
		function url_hook($uri)
		{
			return ($uri == '/scripts.js') ? 10 : 0;
		}
		
		function execute($uri)
		{
			$files = tools::find_files(PATH_PACKAGES, array('extension' => 'js'));
			foreach($files AS $file)
			{
				$this->content .= file_get_contents(PATH_PACKAGES . $file);
			}
			$this->raw_output = true;
		}
	}
?>
