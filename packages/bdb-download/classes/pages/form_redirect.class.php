<?php
  class PageBDBDownloadRedirect extends Page
  {
    function url_hook($uri)
    {
    	$uri_explode = explode('/', $uri);
	return ($uri == '/bilddagboken/submit') ? 20 : 0;
    }

    function execute($uri)
    {
    	if(isset($_POST['image']))
    	{
		preg_match('#http://(.*?).bilddagboken.se/p/show.html\?id=(.*?)&#', $_POST['url'], $matches);

    		$this->redirect = '/bilddagboken/' . $matches[1] . '/' . $matches[2];
    	}
    	
    	if(isset($_POST['user']))
    	{
    		$this->redirect = '/bilddagboken/' . $_POST['username'];
    	}
    	
    	if(isset($_POST['download_zip']))
    	{
    		$this->redirect = '/bilddagboken/' . $_POST['username'] . '/zip';
    	}
    }
  }
?>