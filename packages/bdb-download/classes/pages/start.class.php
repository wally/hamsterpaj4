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
		
		// Any post data?
		if(isset($_POST['url']))
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
			curl_setopt($ch, CURLOPT_URL, $_POST['url']);
			
			// Do fetch code fore imagepage
			if($ce2 = curl_exec($ch))
			{
				tools::debug('Kapar bilden...');
				
			}
			
			// Close curl
			curl_close($ch);
			
			// Check if image exists
			if(preg_match('#<img src="(.*?)" id="picture" />#', $ce2, $image))
			{
				// Image exists, steal image
				tools::debug('Sidan är rätt inslagen, bilden kapas.');
				
				// Create folder for user
				shell_exec('mkdir /mnt/static/bdb-download/' . escapeshellarg($username));
				
				// Get image to Hamsterpajs server
				shell_exec('wget ' . escapeshellarg($image[1]) . ' -O /mnt/static/bdb-download/' . escapeshellarg($username) . '/' . md5($image[1]) . '.jpg');
				
				// Url to image on hamsterpajs server
				$image_url = 'http://static.hamsterpaj.net/bdb-download/' . $username . '/' . md5($image[1]) . '.jpg';
			}
			else
			{
				// Image is not found, error message
				$this->content .= template('bdb-download', 'start.php');	
				$this->content .= '<span style="color: red;">Det finns ingen bild på sidan, eller så kräver användaren att du är vän med honom/henne för att få se bilder.</span>';
				return;
			}
		}
	
		$this->content .= template('bdb-download', 'start.php', array('image_url' => $image_url));	
	}
  }
?>