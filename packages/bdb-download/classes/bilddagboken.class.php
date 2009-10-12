<?php
	class Bilddagboken
	{
		static function connect()
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
				Tools::debug('Loggar in på Bilddagboken');
				if($ce1 == 1)
				{
					Tools::debug('Inloggningen lyckades');
				}
				else
				{
					Tools::debug('Inloggningen misslyckades');
				}
			}
				
			// Settings for imagepage fetch
			curl_setopt($ch, CURLOPT_POST, 0);
			
			return $ch;
		}
		
		static function fetch_page($ch, $url)
		{
			curl_setopt($ch, CURLOPT_URL, $url);
				
			// Do fetch code fore imagepage
			if($ce = curl_exec($ch))
			{
				// Tools::debug('Kapar bilden...');
			}
			
			return $ce;
		}
		
		static function url($data)
		{
			if(preg_match('#<img src="(.*?)" id="picture" />#', $data, $image))
			{
				return $image[1];
			}	
		}
		
		static function download($url, $username, $return = NULL)
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