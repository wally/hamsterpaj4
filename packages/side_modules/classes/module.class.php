<?php
	class Module extends HP4
	{
		public $is_sortable = true;
		public $is_closed = false;
		protected $visible = true;
		
		function execute($page)
		{
			return template('base', 'side_modules/' . $this->template . '.php', array('module' => $this, 'page' => $page));
		}
	}
?>