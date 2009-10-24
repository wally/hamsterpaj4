<?php
	class SideModuleProfileVisitors extends Module
	{
		public $template = 'profile_visitors';
		public $visitors;
		public $id = 'profile_visitors';

		function __construct($user)
		{
			$this->visitors = $user->get('visitors');
			$this->visible = $user->exists();
		}
	}

?>