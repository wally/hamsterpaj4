<?php

class PageJS extends Page
{
	public $content_type = 'text/javascript';
	
	public static function url_hook($uri)
	{
		return ($uri == '/scripts.js') ? 10 : 0;
	}
	
	function execute($uri)
	{
		if(ENVIRONMENT != 'development' && Cache::last_update('js') > (time() - 600))
		{
			header('Content-type: text/javascript');
			header('Expires: ' . date('r', time() + (60 * 60)));
			readfile(Cache::get_name('js'));
			exit;
		}
		
		$files = Tools::find_files(PATH_PACKAGES, array('extension' => 'js'));
		
		// Files that have to be loaded before the restore_error_handler
		array_unshift($files, 'base/js/hp.js');
		array_unshift($files, 'base/js/jquery-1.3.2.min.js');
		
		$files = array_unique($files);
		foreach($files AS $file)
		{
			if ( $file == 'base/js/hp.js' )
			{
			    $this->content .= file_get_contents(PATH_PACKAGES . $file);
			}
			else
			{
			    $this->content .= sprintf('try { %s } catch (e) {
				debug("error in scripts.js: " + e.message); }' . PHP_EOL,
				file_get_contents(PATH_PACKAGES . $file)
			    );
			}
		}
		if ( ENVIRONMENT != 'development' )
		{
		    Cache::save('js', $this->content, false);
		}
		$this->raw_output = true;
	}
}
?>