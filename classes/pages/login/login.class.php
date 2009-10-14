<?php
	class PageLogin extends Page
	{
		function url_hook($url)
		{
			return ($url == '/log-in') ? 10 : 0;
		}
		
		function execute()
		{
			if( strlen($_POST['username']) > 0 )
			{
				if( $user = User::fetch(array('username' => $_POST['username'])) )
				{
					if ( $user->auth($_POST['password']) )
					{
						$this->user = $user;
						$this->user->last_logon = time();
						
						$this->redirect = Tools::pick($_SERVER['HTTP_REFFERER'], '/');
					}
				}
				else
				{
					$this->content = template(NULL, 'pages/login/user_not_found.php', $_POST['username']);
				}
			}
		}
	}
	
	class PageLogout extends Page
	{
		function url_hook($url)
		{
			return ($url == '/logout') ? 10 : 0;
		}
		
		function execute()
		{
			$this->user = new User();
			$this->user->to_session();
		}
	}
?>