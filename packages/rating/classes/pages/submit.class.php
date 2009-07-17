<?php
	class page_rating_submit extends page
	{
		function url_hook($uri)
		{
			return (substr($uri, 0, 14) == '/rating/skicka') ? 10 : 0;
		}

		function execute()
		{
			
			$this->content = $_GET['grade'];
			$this->raw_output = true;
		}
	}
?>