<?php
  class page_bdb_download extends page
  {
    function url_hook($url)
    {
      return ($url == '/bilddagboken') ? 10 : 0;
		}

    function execute()
    {
		$this->menu_active = 'bilddagboken';
		
		$this->content .= template('bdb-download', 'start.php', array('image_url' => $image_url));	
				
		// Running fetch for one image?
		if(isset($_POST['one_image']))
		{
			// Check valid url
			if(!preg_match('#http://(.*?).bilddagboken.se#', $_POST['url'], $username))
			{
				$this->content .= template('bdb-download', 'start.php');	
				$this->content .= '<span style="color: red;">Länken är inte giltig</span>';
				return;
			}
			
			// Get username
			$username = $username[1];
			
			// Connect
			$ch = page_bdb_download::connect();
			
			// Fetch page
			$page = page_bdb_download::fetch_page($ch, $_POST['url']);
			
			// Image url
			$image_url = page_bdb_download::url($page, $username);
			
			// Close curl
			curl_close($ch);
	
			$this->content .= template('bdb-download', 'one_image.php', array('image_url' => $image_url));	
		}
		
		// Running fetch for all images?
		if(isset($_POST['all_images']))
		{
			$username = $_POST['username'];
			
			// Connect
			$ch = page_bdb_download::connect();
			
			// Get first image id and build url
			curl_setopt($ch, CURLOPT_URL, 'http://' . $username . '.bilddagboken.se/p/rss/rss.xml');
			$rss = curl_exec($ch);
			preg_match('#&id=(.*?)]#', $rss, $first_image_id);
			$first_image_id = $first_image_id[1];
			$first_image_url = 'http://' . $username . '.bilddagboken.se/p/show.html?id=' . $first_image_id;

			
			$page = page_bdb_download::fetch_page($ch, $first_image_url);
			$images[] = page_bdb_download::url($page, $username);
			
			// Fetch page
			while(preg_match('#<a href="(.*?)">(Föregående dag|Föregående bild)</a>#', $page))
			{
				// Download prev image
				preg_match('#show.html(.*?)">(Föregående dag|Föregående bild)</a>#', $page, $prev_url);
				$prev_url = 'http://' . $username . '.bilddagboken.se/p/show.html' . $prev_url[1];
				$page = page_bdb_download::fetch_page($ch, $prev_url);
				$images[] = page_bdb_download::url($page, $username);
			}
			
			// Close curl
			curl_close($ch);
	
			$this->content .= template('bdb-download', 'all_images.php', array('images' => $images));	
		}
	
		// Download zip?
		if(isset($_POST['download_zip']))
		{
			$username = $_POST['username'];
			
			// Connect
			$ch = page_bdb_download::connect();
			
			// Get first image id and build url
			curl_setopt($ch, CURLOPT_URL, 'http://' . $username . '.bilddagboken.se/p/rss/rss.xml');
			$rss = curl_exec($ch);
			preg_match('#&id=(.*?)]#', $rss, $first_image_id);
			$first_image_id = $first_image_id[1];
			$first_image_url = 'http://' . $username . '.bilddagboken.se/p/show.html?id=' . $first_image_id;

			
			$page = page_bdb_download::fetch_page($ch, $first_image_url);
			$images[] = page_bdb_download::url($page, $username);
			
			// Fetch page
			while(preg_match('#<a href="(.*?)">(Föregående dag|Föregående bild)</a>#', $page))
			{
				// Download prev image
				preg_match('#show.html(.*?)">(Föregående dag|Föregående bild)</a>#', $page, $prev_url);
				$prev_url = 'http://' . $username . '.bilddagboken.se/p/show.html' . $prev_url[1];
				$page = page_bdb_download::fetch_page($ch, $prev_url);
				$images[] = page_bdb_download::url($page, $username);
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
				$path = page_bdb_download::download($image, $username, 'path');
				
				$zip->addFile($path, end(split('/', $path)));
			}
			
			$zip->close();
	
			$this->content .= '<p>-------------> <a href="http://static.hamsterpaj.net/bdb-download/' . $username . '.zip">Ladda ner: ' . $username . '.zip</a></p>';	
		}
	}
	
	function connect()
	{
		// Path to cookie
		$cookie_file_path = '/home/patrick/cookie.txt';
		
		// Settings for inlog curl
		$ch = curl_init('http://bilddagboken.se/p/frontpage.html?');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'action=login&ajaxlogin=1&pass=humledumle&user=hamster123');
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
		// Do login
		if($ce1 = curl_exec($ch))
		{
			tools::debug('Loggar in på Bilddagboken');
			if($ce1 == 1)
			{
				tools::debug('Inloggningen lyckades');
			}
			else
			{
				tools::debug('Inloggningen misslyckades');
			}
		}
			
		// Settings for imagepage fetch
		curl_setopt($ch, CURLOPT_POST, 0);
		
		return $ch;
	}
	
	function fetch_page($ch, $url)
	{
		curl_setopt($ch, CURLOPT_URL, $url);
			
		// Do fetch code fore imagepage
		if($ce = curl_exec($ch))
		{
			// tools::debug('Kapar bilden...');
		}
		
		return $ce;
	}
	
	function url($data)
	{
		if(preg_match('#<img src="(.*?)" id="picture" />#', $data, $image))
		{
			return $image[1];
		}	
	}
	
	function download($url, $username, $return = NULL)
	{
		// Create folder for user
		shell_exec('mkdir /mnt/static/bdb-download/' . escapeshellarg($username));
		
		// Get image to Hamsterpajs server
		shell_exec('wget ' . escapeshellarg($url) . ' -O /mnt/static/bdb-download/' . escapeshellarg($username) . '/' . md5($url) . '.jpg');
			
		if($return == 'path')
		{
			return '/mnt/static/bdb-download/' . $username . '/' . md5($url) . '.jpg';
		}
		else
		{
			// Url to image on hamsterpajs server
			return 'http://static.hamsterpaj.net/bdb-download/' . $username . '/' . md5($url) . '.jpg';
		}
	}
  }
?>