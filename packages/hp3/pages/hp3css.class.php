<?php

class PageHP3CSS extends Page
{
    public $raw_output = true;
    public $content_type = 'text/css';
    
    public static function url_hook($uri)
    {
	return (substr($uri, 0, 14) == '/old_style.css' ? 10 : 0);
    }
    
    public function execute($uri)
    {
	$files = trim(substr($uri, 15), ', ');
	$files = explode(',', $files);
	
	$files = array_merge($files, HP3Config::$standard_css);
	
	$dir = dirname(__FILE__) . '/../css/';
	
	if ( empty($files[0]) && count($files) > 1 )
	{
	    $files = array_slice($files, 1);
	}
	elseif ( empty($files[0]) )
	{
	    return '';
	}
	
	$orig_uri = $_SERVER['REQUEST_URI'];
	foreach ( $files as $filename )
	{
	    $file = preg_replace(HP3Config::$rewrites_css, HP3Config::$replaces_css, $filename);
	    
	    if ( file_exists($dir . $file) && ! strstr($file, '..') )
	    {
		$this->content .= sprintf('/* %s */', $file);
		
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
	    }
	}
	$_SERVER['REQUEST_URI'] = $orig_uri;
    }
}
