<?php
	class page_mobile_blog_list extends page
	{
		function url_hook($uri)
		{
			return (substr($uri, 0, 17) == '/mobilblogg/lista') ? 10 : 0;
		}
		
		function execute()
		{
			$request = split('/', $_SERVER['REQUEST_URI']);
			$object = $request[3];
			
			switch($object)
			{
				case 'dig-sjalv':
					// hämta dina
					$owner = 'dina';
					$this->content = template('pages/mobile_blog/list.php', array('posts' => $posts, 'user' => $this->user, 'owner' => $owner));
				break;
				
				case 'anvandare':
					if(!$user = user::fetch(array('username' => $request[4])))
					{
						$this->content = '<h1>Användaren kunde inte hittas</h1>';
						break;
					}
					
					tools::debug($user);
					$owner = $user->username . '\'s';
					$this->content = template('pages/mobile_blog/list.php', array('posts' => $posts, 'user' => $user, 'owner' => $owner));
				break;
				
				default:
					// Hämta vänners
					$owner = 'dina vänners';
					$this->content = template('pages/mobile_blog/list.php', array('posts' => $posts, 'owner' => $owner));
				break;
			}
		}
	}
?>
