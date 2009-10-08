<?php
	class page_user_profile extends page
	{
		function url_hook($uri)
		{
			
			preg_match('#^/(.*?)(/|$)#', $uri, $username);
			$username = $username[1];
			tools::debug($username);
			
			$user = user::fetch(array('username' => $username));
			
			if(is_object($user) && $user->exists())
			{
				return 3;
			}
			else
			{
				return 1;
			}
			tools::debug($user);
		}
		
		function execute($uri)
		{
			preg_match('#^/(.*?)(/|$)#', $uri, $username);
			$username = $username[1];
			tools::debug($username);
			
			$user = user::fetch(array('username' => $username));
			
			$this->redirect = '/traffa/profile.php?user_id=' . $user->get('id');
			
		}
	}
?>