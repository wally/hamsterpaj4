<?php
	class tag
	{
		function fetch($search)
		{
			global $_PDO;

			$query = 'SELECT t.id, t.title, t.handle, t.popularity, tao.item_id, tao.tag_id FROM tags as t, tags_ownage as tao WHERE 1';
			$query .= (isset($search['system'])) ? ' AND tao.system = :system AND t.system = tao.system' : null;
			$query .= (isset($search['item_id'])) ? ' AND tao.item_id = :item_id AND tao.tag_id = t.id' : null;
			$query .= (isset($search['order_by'])) ? ' ORDER BY ' . $search['order_by'] : null;
			$query .= (isset($search['limit'])) ? ' LIMIT :limit' : null;

			$stmt = $_PDO->prepare($query);
			(isset($search['system'])) ? $stmt->bindValue(':system', $search['system']) : null;
			(isset($search['item_id'])) ? $stmt->bindValue(':item_id', $search['item_id']) : null;
			(isset($search['limit'])) ? $stmt->bindValue(':limit', $search['limit'], PDO::PARAM_INT) : null;
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$tag = new tag();				
				
				$tag->id = $row['id'];
				$tag->title = $row['title'];
				$tag->handle = $row['handle'];
				$tag->popularity = $row['popularity'];

				$tags[] = $tag;
			}

			return $tags;
		}
		
		function save($data)
		{
			global $_PDO;
			
			if($this->id > 0)
			{
				$query = 'UPDATE tags SET title = :title, system = :system, popularity = :popularity WHERE id = :id LIMIT 1';
				
				$stmt = $_PDO->prepare($query);
				$stmt->bindValue(':id', $this->id);
				$stmt->bindValue(':title', $this->title); 
				$stmt->bindValue(':system', $this->system);
				$stmt->bindValue(':popularity', $this->popularity);
				$stmt->execute();
			}
			else
			{
				$query = 'INSERT INTO tags (handle, title, system, popularity)';
				$query .= ' VALUES(:title, :system, :popularity)';

				$stmt = $_PDO->prepare($query);
				$stmt->bindValue(':handle', $this->handle);
				$stmt->bindValue(':title', $this->title); 
				$stmt->bindValue(':system', $this->system);
				$stmt->bindValue(':popularity', $this->popularity);
				if(!$stmt->execute())
				{
					tools::debug($stmt->errorInfo());
				}
			}
		}
		
		function save_to_item($tags, $system, $item_id)
		{
			global $_PDO;
			
				$query = 'UPDATE tags_ownage SET system = :system, item_id = :item_id, tag_id = :tag_id WHERE id = :id LIMIT 1';
				
				$stmt = $_PDO->prepare($query);
				$stmt->bindValue(':id', $this->id);
				$stmt->bindValue(':title', $this->title); 
				$stmt->bindValue(':system', $this->system);
				$stmt->bindValue(':popularity', $this->popularity);
				if(!$stmt->execute())
				{
					$query = 'INSERT INTO tags (handle, title, system, popularity)';
					$query .= ' VALUES(:title, :system, :popularity)';
	
					$stmt = $_PDO->prepare($query);
					$stmt->bindValue(':handle', $this->handle);
					$stmt->bindValue(':title', $this->title); 
					$stmt->bindValue(':system', $this->system);
					$stmt->bindValue(':popularity', $this->popularity);
					if(!$stmt->execute())
					{
						tools::debug($stmt->errorInfo());
					}
				}
			
		}
		
		function render_form($system, $item_id = NULL)
		{
			$instanses = tag::fetch(array('system' => 'entertain'));
			
			foreach($instanses as $instance)
			{
				$tags[] = $instance->title;
			}
			
			return template('tags', 'choose_tags.php', array('tags' => $tags));
		}
	}
?>