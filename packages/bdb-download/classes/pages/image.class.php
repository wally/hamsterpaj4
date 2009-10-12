<?php
class PageBDBDownloadImage extends Page
{
    function url_hook($uri)
    {
        $uri_explode = explode('/', $uri);
    
	if (count($uri_explode) >= 4 && $uri_explode[1] == 'ajax' && $uri_explode[2] == 'bilddagboken' && isset($uri_explode[3]) && is_numeric($uri_explode[4]))
	{
	    return 8;
	}
	else
	{
	    return 0;
	}
    }

    function execute($uri)
    {
	$this->menu_active = 'bilddagboken';
	
	$uri_explode = explode('/', $uri);
	
	$username = $uri_explode[3];
	$id = $uri_explode[4];
	$url = 'http://' . $username . '.bilddagboken.se/p/show.html?id=' . $id . '&directlink=1';
	
	// Connect
	$ch = Bilddagboken::connect();
	
	// Fetch page
	$page = Bilddagboken::fetch_page($ch, $url);
	
	// Image url
	$image_url = Bilddagboken::url($page, $username);
	
	// Close curl
	curl_close($ch);
	
	$this->content .= template('bdb-download', 'image.php', array('image_url' => $image_url));	
	$this->raw_output = true;
    }
}
