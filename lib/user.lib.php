<?php
	class user
	{
		public $last_action, $last_logon, $signature, $visitors;
		
		public function online()
		{
			return ($this->last_action > time() - 600);
		}
		
		public function exists()
		{
			return ($this->id > 0);
		}
		
		public function from_session($session)
		{
			if(isset($session['login']['id']))
			{
				$this->id = $session['login']['id'];
				$this->username = $session['login']['username'];
				$this->last_action = $session['login']['lastaction'];
				$this->last_logon = $session['login']['last_logon'];
				$this->signature = $session['userinfo']['user_status'];
			}
			
			debug('Loading user form session');
		}
		
		public function to_session()
		{
			$_SESSION['login']['id'] = $this->id;
			$_SESSION['login']['username'] = $this->username;
			$_SESSION['login']['last_action'] = $this->last_action;
			$_SESSION['login']['last_logon'] = $this->last_logon;
			$_SESSION['userinfo']['user_status'] = $this->signature;
		}
		
		public function lastaction()
		{
			$this->lastaction = time();
		}
		
		public function fetch($search)
		{
			$search['username'] = (isset($search['username']) && !is_array($search['username'])) ? array($search['username']) : '';
			
			$user = new user();
			$query = 'SELECT l.id, l.username, l.password, l.lastlogon';
			$query .= ', u.user_status';
			$query .= ' FROM login AS l, userinfo AS u';
			$query .= ' WHERE u.userid = l.id';
			$query .= (count($search['username']) > 0) ? ' AND l.username IN ("' . implode('", "', $search['username']) . '")' : '';
			
			debug($query);
			
			foreach($this->pdo->query($query) AS $row)
			{
				$user->id = $row['id'];
				$user->username = $row['username'];
				$user->password = $row['password'];
				$user->last_logon = $row['lastlogon'];
				$user->signature = $row['user_status'];

				return $user;
			}
			return false;
		}
		
		public function auth($password)
		{
			return (secret::password_hash($password) == $this->password);
		}
		
		function profile_url()
		{
			return '/traffa/profile.php?id=' . $this->id;
		}
		
		function avatar_thumb_url()
		{
			return 'http://images.hamsterpaj.net/images/users/thumb/' . $this->id . '.jpg';
		}
		
		function get_visitors()
		{
			debug('Get visitors!');
		}
		
	}
?>