<?php
	class PageCommentPost extends Page
	{
		public static function url_hook($uri)
		{
			return (substr($uri, 0, 17) == '/kommentar/skicka') ? 10 : 0;
		}

		function execute()
		{
			if(!$this->user->exists())
			{
				throw new Exception('Du måste vara inloggad för att använda den här funktionen');
			}
			
			$comment = new Comment();
			$comment->item_id = $_POST['item_id'];
			$comment->text = $_POST['text'];
			$comment->type = $_POST['type'];
			$comment->user = $this->user;
			
			if($comment->content_check())
			{
				$comment->add();
				$this->content = template('comment', 'comment.php', array('user' => $this->user, 'text' => $_POST['text'], 'timestamp' => time()));
			}
			else
			{
				$this->content = '<div class="error">Usch, vi på Hamsterpaj blir så trötta på alla dessa spam-länkar. Det här spam-försöket loggades och du kommer att bli blockerade från sidan vid upprepade försök.</div>';
			}
			
			$this->raw_output = true;
		}
	}
?>