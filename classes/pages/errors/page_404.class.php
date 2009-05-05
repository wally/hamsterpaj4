<?php
	class page_404 extends page
	{
		function execute()
		{
			$this->content = '<h1>404 not found</h1>';
		}
	}
?>