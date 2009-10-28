<?php

class PageHP3JS extends Page
{
    public $raw_output = true;
    public $content_type = 'text/javascript';
    
    public static function url_hook($uri)
    {
	return (String::beginswith($uri, '/old_javascripts.js') ? 10 : 0);
    }
    
    public function execute($uri)
    {
	$files = trim(substr($uri, strpos($uri, '/', 3)), ', ');
	$files = explode(',', $files);
	
	$dir = PATH_HP3 . 'javascripts/';
	
	if ( empty($files[0]) )
	{
	    return '';
	}
	
	$orig_uri = $_SERVER['REQUEST_URI'];
	foreach ( $files as $filename )
	{
	    $file = $filename;
	    
	    if ( file_exists($dir . $file) && ! strstr($file, '..') )
	    {
		$this->content .= sprintf('/* %s */ try {', $file);
		
		if ( substr($file, -4) != '.php' )
		{
		    $this->content .= file_get_contents($dir . $file);
		}
		else
		{
		    $_SERVER['REQUEST_URI'] = $filename;
		    ob_start();
		    include($dir . $file);
		    $this->content .= ob_get_clean();
		}
		
		$this->content .= ' } catch ( e ) { debug("error in ' . $filename . '"); } ';
	    }
	}
	$_SERVER['REQUEST_URI'] = $orig_uri;
    }
}
