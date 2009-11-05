<?php

class PageHP3Stylesheet extends Page
{
    public $raw_output = true;
    
    public static function url_hook($uri)
    {
	return String::beginswith($uri, '/stylesheets/') ? 20 : 0;
    }
    
    public function execute($uri)
    {
	$filename = str_replace('/stylesheets/', '', $uri);
	$path = dirname(__FILE__) . '/../css/' . $filename;
	if ( ! strstr($uri, '..') && file_exists($path) )
	{
	    $this->content_type = 'text/css';
	    $this->content = file_get_contents($path);
	}
	else
	{
	    header('HTTP/1.0 404 Not Found');
	    $this->content = '<html><head><title>Filen hittades inte!</title></head><body><h1>Filen ' . $filename . ' hittades inte!</h1></body></html>';
	}
    }
}

?>
