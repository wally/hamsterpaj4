<?php
	class PageLogin extends Page
	{
		function url_hook($url)
		{
			return ($url == '/log-in') ? 10 : 0;
		}
		
		function execute()
		{
			if( strlen(@$_POST['username']) > 0 )
			{
				if( $user = User::fetch(array('username' => $_POST['username'])) )
				{
					if ( $user->auth($_POST['password']) )
					{
						$this->user = $user;
						$this->user->last_logon = time();
					}
					else
					{
						$this->user->notifications[] = array(NULL, 'pages/login/wrong_password.php', array('username' => $_POST['username']));
					}
				}
				else
				{
					$this->user->notifications[] = array(NULL, 'pages/login/user_not_found.php', array('username' => $_POST['username']));
				}
			}
			
			$this->redirect = Tools::pick($_SERVER['HTTP_REFERER'], '/');
			
			if ( strstr($this->redirect, '/log-in') )
			{
			    $this->redirect = '/';
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
			
			$this->redirect = Tools::pick($_SERVER['HTTP_REFERER'], '/');
		}
	}
    