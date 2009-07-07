<?php
	// comment_list class must be loaded beföre this.
	require_once PATH_CLASSES . 'comments/comment_list.class.php';

	class comment extends comment_list
	{
		function build_comment($data)
		{
			$this->user = user::fetch(array('id' => $this->user_id));
		}
		
		function render($user)
		{
			$this->remove_privilegied = $user->privilegied('comments_admin', $this->type);
			
			return template(NULL, 'comment/comment.php', $this);
		}
		
		function add()
		{
			global $_PDO;
			
			$query = 'INSERT INTO comments
								SET 
									item_id = "' . $this->item_id . '", 
									type = "' . $this->type . '", 
									timestamp = UNIX_TIMESTAMP(), 
									text = "' . $this->text . '", 
									user_id = ' . $this->user->get('id') . '
							 ';
			tools::debug($query);
			$_PDO->exec($query);
		}
		
		function remove()
		{
			global $_PDO;
			
			$query = 'UPDATE comments SET removed = 1 WHERE id = "' . $this->id . '" LIMIT 1';
			$_PDO->exec($query);
		}
	}
?>