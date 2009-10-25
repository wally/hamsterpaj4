<?php
	class PageUserProfile extends Page
	{
		public static function url_hook($uri)
		{
			preg_match('#^/([a-z0-9_-]+)$#', $uri, $username);
			if ( ! isset($username[1]) )
			{
			    return 0;
			}
			$username = $username[1];
			Tools::debug($username);
			
			$user = User::fetch(array('username' => $username));
			
			if(is_object($user) && $user->exists())
			{
				return 2;
			}
			else
			{
				return 0;
			}
			Tools::debug($user);
			
		}
		
		function execute($uri)
		{
			preg_match('#^/(.*?)(/|$)#', $uri, $username);
			$username = $username[1];
			Tools::debug($username);
			
			$user = User::fetch(array('username' => $username));
			
			$this->redirect = '/traffa/profile.php?user_id=' . $user->get('id');
			
		}
	}
