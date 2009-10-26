<?php
	class SideModuleAdministration extends Module
	{
		public $template = 'administration';
		public $id = 'administration';
		public $gb_autoreports;
		public $avatar_validates;
		public $abuses;
		public $privileges_needed;
		
		function __construct($user)
		{
			global $_PDO;
			
			// Which privileges are needed? (Only one of those)
			$privileges_needed = array('discussion_forum_remove_posts', 'discussion_forum_edit_posts', 'discussion_forum_rename_threads', 'discussion_forum_lock_threads', 'discussion_forum_sticky_threads', 'discussion_forum_move_thread', 'discussion_forum_post_addition');
			
			// Should this module be displayed?
			$this->visible = false;
			foreach($privileges_needed as $privilege)
			{
				if($user->privilegied($privilege))
				{
					$this->visible = true;
				}
			}
			
			// If module shouldn't be displayed we can kill it here..
			if($this->visible == false)
			{
				return false;
			}
			
			// Fetch some abuses data
			if($user->privilegied('discussion_forum_remove_posts'))
			{
				$query = 'SELECT COUNT(*) AS reports FROM abuse WHERE reply_timestamp = 0';
				$stmt = $_PDO->query($query);
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				$this->abuses = $data['reports'];
			}
			
			// Fetch some avatar validating data
			if($user->privilegied('avatar_admin'))
			{
				$query = 'SELECT COUNT(*) AS new_images FROM userinfo WHERE image = 1';
				$stmt = $_PDO->query($query);
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				$this->avatar_validates = $data['new_images'];
			}
			
	
			// Fetch some Automagisk gb reports
			if($user->privilegied('gb_autoreport'))
			{
				$query = 'SELECT COUNT(*) posts';
				$query .= ' FROM gb_autoreport_posts AS garp';
				$query .= ' JOIN gb_autoreport_strings AS gars ON gars.id = garp.string_id ';
				$query .= ' JOIN traffa_guestbooks AS gb ON gb.id = garp.gb_id';
				$query .= ' JOIN login AS l ON l.id = gb.sender AND l.is_removed = 0';
				$query .= ' WHERE garp.checked = 0';
				$stmt = $_PDO->query($query);
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$this->gb_autoreports = $data['posts'];
			}
		}
	}
?>