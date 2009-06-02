<?php
	class page_comment_post extends page
	{
		function url_hook($uri)
		{
			return (substr($uri, 0, 17) == '/kommentar/skicka') ? 10 : 0;
		}

		function execute()
		{
			if(!$this->user->exists())
			{
				throw new Exception('Du måste vara inloggad för att använda den här funktionen');
			}
			
			$comment = new comment;
			
			$comment->item_id = $_GET['item_id'];
			$comment->text = $_GET['text'];
			$comment->type = $_GET['type'];
			$comment->user = $this->user;
			$comment->add();
			
			$this->content = template('comment/comment.php', array('user' => $this->user, 'text' => $_GET['text'], 'timestamp' => time()));
			$this->raw_output = true;
		}
	}
?>