<?php
	class comment_list extends hp4
	{
		/*
			HOW TO USE THIS class:
			$comment_list = new comment_list;
			$comment_list->user = $this->user;
			$comment_list->type = 'photos';
			$comment_list->item_id = $id;
			$comment_list->limit = 22;
			$comment_list->fetch_comments();
			$comment_list->render();
		*/
		function fetch_comments()
		{
			global $_PDO;

			// Set default in-data
			$this->limit = isset($this->limit) ? $this->limit : COMMENT_DEFAULT_LIMIT;
			
			$query = $_PDO->prepare('SELECT text, item_id, type, timestamp, user_id, id FROM comments WHERE item_id = :item_id AND type = :type AND removed = 0 LIMIT :limit');
			$query->bindParam(':limit', $this->limit, PDO::PARAM_INT);
			$query->bindParam(':item_id', $this->item_id, PDO::PARAM_INT);
			$query->bindParam(':type', $this->type, PDO::PARAM_STR, 20);
			$query->execute();
			$comments = $query->fetchAll(PDO::FETCH_ASSOC);
			$this->comments = array();
			foreach($comments as $comment_data)
			{
				$comment = new comment;
				$comment->set($comment_data);
				$comment->build_comment();
				$this->comments[] = $comment;
			}
			
			return true;
		}
		
		function render()
		{
			$comment_list->out = template('comment', 'list.php', $this);
			$comment_list->out .= (isset($this->user) && $this->user->exists()) ? template('comment', 'form.php', $this) :  template('comment', 'error_not_member.php');
			
			return $comment_list->out;
		}
	}
?>
