<?php
	class SideModuleCrew extends Module
	{
		public $template = 'crew';
		public $id = 'crew';
		public $members = array();

		function __construct()
		{
			global $_PDO;
			
			if(Cache::last_update('online_crew') < (time() - 300) )
			{
				$query = 'SELECT l.username AS username, l.id AS user_id FROM login AS l, privilegies AS pl WHERE pl.user = l.id AND pl.privilegie = "user_management_admin" ORDER BY lastaction DESC LIMIT 5';
				foreach($_PDO->query($query) AS $row)
				{
					$member = new User;
					$member->set(array('username' => $row['username'], 'id' => $row['user_id']));
					$this->members[] = $member;
				}

				Cache::save('online_crew', $this->members);
			}
			else
			{
				$this->members = Cache::load('online_crew');
			}
		}
	}
?>