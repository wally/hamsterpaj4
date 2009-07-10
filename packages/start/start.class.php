<?php
	class page_start extends page
	{
		function url_hook($uri)
		{
			return ($uri == '') ? 10 : 0;
		}
		
		function execute()
		{
			$this->content = '<h1>Startsida!</h1>';
			
			$entertain = entertain::fetch(array('limit' => 3, 'allow_multiple' => true, 'category' => 'onlinespel'));
			$full = array_pop($entertain);
			$this->content .= $full->preview_full();
			$this->content .= entertain::previews($entertain);
		}
	}
?>