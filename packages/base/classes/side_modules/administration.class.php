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
		}
	}

?>