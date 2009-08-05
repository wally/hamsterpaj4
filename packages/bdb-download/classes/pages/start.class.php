<?php
  class page_bdb_download_start extends page
  {
    function url_hook($url)
    {
      return (substr($url, 0, 13)  == '/bilddagboken') ? 10 : 0;
		}

    function execute($uri)
    {
			$this->menu_active = 'bilddagboken';
			
			
			
			
			$uri_explode = explode('/', $uri);
			
			if($uri_explode[3] == 'zip')
			{
				$this->content .= template('bdb-download', 'form.php', array('username_zip' => $uri_explode[2]));	
				
				$url = '/ajax/bilddagboken/' . $uri_explode[2] . '/zip';
				$this->content .= template('bdb-download', 'ajax_load.php', array('url' => $url));	
			}
			elseif(is_numeric($uri_explode[3]))
			{
				$image_url = 'http://' . $uri_explode[2] . '.bilddagboken.se/p/show.html?id=' . $uri_explode[3] . '&directlink=1';
				$this->content .= template('bdb-download', 'form.php', array('url' => $image_url));	
				
				$url = '/ajax/bilddagboken/' . $uri_explode[2] . '/' . $uri_explode[3];
				$this->content .= template('bdb-download', 'ajax_load.php', array('url' => $url));	
			}
			elseif(isset($uri_explode[2]))
			{
				$this->content .= template('bdb-download', 'form.php', array('username' => $uri_explode[2]));	
				
				$url = '/ajax/bilddagboken/' . $uri_explode[2];
				$this->content .= template('bdb-download', 'ajax_load.php', array('url' => $url));	
			}
			else
			{
				$this->content .= template('bdb-download', 'form.php');	
			}
		}
  }
?>