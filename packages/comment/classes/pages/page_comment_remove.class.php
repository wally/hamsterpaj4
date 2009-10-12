<?php
	class PageCommentRemove extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/kommentar/radera') ? 10 : 0;
		}

		function execute()
		{
			if( ! $this->user->privilegied('comments_admin', $_GET['type']) )
			{
				throw new Exception('Du måste vara inloggad för att använda den här funktionen');
			}
			
			$comment = new Comment;
			
			$comment->id = $_GET['id'];
			$comment->remove();
			
			$this->raw_output = true;
		}
	}
?>