<?php
	class user extends hp4
	{
		public $last_action, $last_logon, $signature, $visitors, $pdo;
		
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
		
		public function fetch($search, $params = array())
		{
			global $_PDO;

			// Bug, only allows one entry
			$search['username'] = (isset($search['username']) && !is_array($search['username'])) ? array($search['username']) : array();
			$search['limit'] = (isset($search['limit'])) ? $search['limit'] : 1;
			$search['order-by'] = (isset($search['order-by'])) ? $search['order-by'] : 'l.id';
			$search['order-direction'] = (isset($search['order-direction'])) ? $search['order-direction'] : 'ASC';
			
			$user = new user();
			$query = 'SELECT l.id, l.username, l.password, l.lastlogon';
			$query .= ', u.user_status';
			
			$query .= ($search['has_visited'] > 0) ? ', uv.timestamp AS last_visit, uv.count AS visit_count' : null;
			
			$query .= ' FROM login AS l, userinfo AS u';

			$query .= ($search['has_visited'] > 0) ? ', user_visits AS uv' : null;

			$query .= ' WHERE u.userid = l.id';
			$query .= (count($search['username']) > 0) ? ' AND l.username IN ("' . implode('", "', $search['username']) . '")' : null;
			$query .= ($search['has_image'] == true) ? ' AND (u.image = 1 OR u.image = 2)' : null;
			$query .= ($search['has_visited'] > 0) ? ' AND l.id = uv.item_id AND uv.type = "profile_visit" AND uv.user_id = "' . $search['has_visited'] . '"' : null;

			$query .= ' ORDER BY ' . $search['order-by'] . ' ' . $search['order-direction'];
			$query .= ' LIMIT ' . $search['limit'];

			tools::debug($query);

			foreach($_PDO->query($query) AS $row)
			{
				$user = new user();
				$user->id = $row['id'];
				$user->username = $row['username'];
				$user->password = $row['password'];
				$user->last_logon = $row['lastlogon'];
				$user->signature = $row['user_status'];
				$user->last_visit = $row['last_visit'];

				if($params['allow_multiple'] == true)
				{
					$users[] = $user;
				}
				else
				{
					return $user;
				}
			}
			return ($params['allow_multiple'] == true) ? $users : false;
		}
		
		public function get_unread_gb_entries()
		{
			if(isset($this->unread_gb_entries))
			{
				return count($this->unread_gb_entries);
			}
			else
			{
				$search = array('recipient' => $this->id, 'force_unread' => true, 'allow_anonymous' => true);
				$this->unread_gb_entries = guestbook::fetch($search);
				return count($this->unread_gb_entries);
			}
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
			if($this->id < 1)
			{
				return false;
			}
			if(count($this->visitors) == 0)
			{
				$search = array('has_image' => true, 'has_visited' => $this->id, 'limit' => USER_VISITORS_LIMIT, 'order-by' => 'last_visit', 'order-direction' => 'DESC');
				$params = array('allow_multiple' => true);
				$this->visitors = user::fetch($search, $params);
			}
			return $this->visitors;
		}
		
	}
?>