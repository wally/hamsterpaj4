<?php
	class PageUserProfile extends Page
	{
		function url_hook($uri)
		{
			preg_match('#^/(.*?)(/|$)#', $uri, $username);
			if ( ! isset($username[1]) )
			{
			    return 1;
			}
			$username = $username[1];
			Tools::debug($username);
			
			$user = User::fetch(array('username' => $username));
			
			if(is_object($user) && $user->exists())
			{
				return 3;
			}
			else
			{
				return 1;
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
