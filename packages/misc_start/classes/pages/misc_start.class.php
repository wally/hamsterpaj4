<?php
	class PageMiscStart extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/under_mattan') ? 10 : 0;
		}
		
		function execute()
		{
			$this->menu_active = 'under_mattan';
			$this->content = '<h1>Under mattan</h1>';			
		}
	}
?>