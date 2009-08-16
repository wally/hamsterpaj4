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
			$comment->item_id = $_POST['item_id'];
			$comment->text = $_POST['text'];
			$comment->type = $_POST['type'];
			$comment->user = $this->user;
			$comment->add();
			
			tools::debug($_GET);
			
			$this->content = template('comment', 'comment.php', array('user' => $this->user, 'text' => $_POST['text'], 'timestamp' => time()));
			$this->raw_output = true;
		}
	}
?>