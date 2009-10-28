<?php

class PageHP3Stylesheet extends Page
{
    public $content_type = 'text/css';
    public $raw_output = true;
    
    public static function url_hook($uri)
    {
	return String::beginswith($uri, '/stylesheets/')
	    && file_exists(dirname(__FILE__) . '/../css/' . str_replace('/stylesheets/', '', $uri) ) ? 20 : 0;
    }
    
    public function execute($uri)
    {
	$filename = str_replace('/stylesheets/', '', $uri);
	if ( ! strstr($uri, '..') )
	{
	    $path = dirname(__FILE__) . '/../css/' . $filename;
	    $this->content = file_get_contents($path);
	}
    }
}
