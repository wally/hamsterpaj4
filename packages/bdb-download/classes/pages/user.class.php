<?php
  class page_bdb_download_user extends page
  {
    function url_hook($url)
    {
      return (substr($url, 0, 19) == '/ajax/bilddagboken/') ? 5 : 0;
		}

    function execute($uri)
    {
    	$uri_explode = explode('/', $uri);
    	tools::debug($uri_explode);
			$this->menu_active = 'bilddagboken';
					
			$username = $uri_explode[3];
				
			// Connect
			$ch = bilddagboken::connect();
				
			// Get first image id and build url
			curl_setopt($ch, CURLOPT_URL, 'http://' . $username . '.bilddagboken.se/p/rss/rss.xml');
			$rss = curl_exec($ch);
			preg_match('#&id=(.*?)]#', $rss, $first_image_id);
			$first_image_id = $first_image_id[1];
			$first_image_url = 'http://' . $username . '.bilddagboken.se/p/show.html?id=' . $first_image_id;
	
				
			$page = bilddagboken::fetch_page($ch, $first_image_url);
			$images[] = bilddagboken::url($page, $username);
				
			// Fetch page
			while(preg_match('#<a href="(.*?)">(Föregående dag|Föregående bild)</a>#', $page))
			{
				// Download prev image
				preg_match('#show.html(.*?)">(Föregående dag|Föregående bild)</a>#', $page, $prev_url);
				$prev_url = 'http://' . $username . '.bilddagboken.se/p/show.html' . $prev_url[1];
				$page = bilddagboken::fetch_page($ch, $prev_url);
				$images[] = bilddagboken::url($page, $username);
			}
				
			// Close curl
			curl_close($ch);
			
			$this->content .= template('bdb-download', 'user.php', array('images' => $images));	
			$this->raw_output = true;
		}
  }
?>