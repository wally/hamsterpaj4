<?php
	class side_module_profile_visitors extends module
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