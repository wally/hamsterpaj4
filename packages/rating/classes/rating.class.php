<?php
	class Rating
	{
		function save()
		{
			global $_PDO;
			
			$query = 'INSERT INTO rating (item_id, system, grade, user_id)';
			$query .= ' VALUES(:item_id, :system, :grade, :user_id)';
	
			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':item_id', $this->item_id); 
			$stmt->bindValue(':system', $this->system);
			$stmt->bindValue(':grade', $this->grade);
			$stmt->bindValue(':user_id', $this->user_id);
			if(!$stmt->execute())
			{
				return $stmt->errorInfo();
			}
		}
	}
?>