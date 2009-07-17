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
			$rating = new rating;
			$rating->grade = $_GET['grade'];
			$rating->item_id = $_GET['item_id'];
			$rating->system = $_GET['system'];
			$rating->user_id = $this->user->id;
			$this->content .=  tools::preint_r($rating->save());
			$this->raw_output = true;
		}
	}
?>