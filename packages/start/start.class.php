<?php
	class PageStart extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '') ? 0 : 0;
		}
		
		function execute()
		{
			$this->menu_active = 'start';
			
			$this->content = '<h1>Startsida!</h1>';
			
			$entertain = Entertain::fetch(array('limit' => 3, 'allow_multiple' => true, 'category' => 'onlinespel', 'status' => 'released'));
			$full = $entertain[0];
			$this->content .= $full->preview_full();
			$this->content .= Entertain::previews($entertain);
		}
	}
?>