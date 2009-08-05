<?php
  class page_bdb_download_zip extends page
  {
    function url_hook($uri)
    {
    	$uri_explode = explode('/', $uri);
 
	    if($uri_explode[1] == 'ajax' && $uri_explode[2] == 'bilddagboken' && isset($uri_explode[3]) && $uri_explode[4] == 'zip')
	    {
	      return 9;
	    }
	    else
	    {
	    	return 0;
	    }
		}

    function execute($uri)
    {
    	$uri_explode = explode('/', $uri);
    	
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
				
			$zip = new ZipArchive();
			$filename = '/mnt/static/bdb-download/' . $username . '.zip';
			file_exists($filename) ? unlink($filename) : NULL;
			if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
				exit("cannot open <$filename>\n");
			}
				
			foreach($images as $image)
			{
				$path = bilddagboken::download($image, $username, 'path');
				
				$zip->addFile($path, end(split('/', $path)));
			}
			
			$zip->close();
			
			foreach($images as $image)
			{
				unlink('/mnt/static/bdb-download/' . $username . '/' . md5($image) . '.jpg');
			}
			
			rmdir('/mnt/static/bdb-download/' . $username);
		
			$this->content .= template('bdb-download', 'zip.php', array('username' => $username));
			$this->raw_output = true;
		}
  }
?>