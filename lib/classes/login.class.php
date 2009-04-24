<?php
	class page_login extends page
	{
		function execute()
		{
			if(strlen($_POST['username']) > 0)
			{
				if($user = user::fetch(array('username' => $_POST['username'])))
				{
					if($user->auth($_POST['password']))
					{
						$this->user = $user;
						$this->user->last_logon = time();
					}
				}
				else
				{
					$this->content = template('login/user_not_found.php', $_POST['username']);
				}
			}
		}
	}
	
	class page_logout extends page
	{
		function execute()
		{
			$this->user = new user();
			$this->user->to_session();
		}
	}
?>