<?php
	class tag
	{
		function fetch($search)
		{
			global $_PDO;

			$query = 'SELECT t.id, t.title, t.handle, t.popularity, tao.item_id, tao.tag_id FROM tags as t, tags_ownage as tao WHERE 1';
			$query .= (isset($search['system'])) ? ' AND tao.system = :system AND t.system = tao.system' : null;
			$query .= (isset($search['item_id'])) ? ' AND tao.item_id = :item_id AND tao.tag_id = t.id' : null;
			$query .= (isset($search['handle'])) ? ' AND t.handle = :handle  AND tao.tag_id = t.id' : null;
			$query .= (isset($search['order_by'])) ? ' ORDER BY ' . $search['order_by'] : null;
			$query .= (isset($search['limit'])) ? ' LIMIT :limit' : null;

			$stmt = $_PDO->prepare($query);
			(isset($search['system'])) ? $stmt->bindValue(':system', $search['system']) : null;
			(isset($search['item_id'])) ? $stmt->bindValue(':item_id', $search['item_id']) : null;
			(isset($search['handle'])) ? $stmt->bindValue(':handle', $search['handle']) : null;
			(isset($search['limit'])) ? $stmt->bindValue(':limit', $search['limit'], PDO::PARAM_INT) : null;
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$tag = new tag();				
				
				$tag->id = $row['id'];
				$tag->item_id = $row['item_id'];
				$tag->title = $row['title'];
				$tag->handle = $row['handle'];
				$tag->popularity = $row['popularity'];

				$tags[] = $tag;
			}
			
			if(isset($tags[0]->id))
			{
				return $tags;
			}
			else
			{
				return false;
			}
		}
		
		function save($data)
		{
			global $_PDO;
			
			$subtags = split(',', $data['subtags']);
			
			$mastertags = $data['mastertags'];
			
			if(count($mastertags) > 0 && count($subtags) > 0)
			{
				$tags = array_merge($subtags, $mastertags);
			}
			elseif(count($mastertags) > 0)
			{
				$tags = $mastertags;
			}
			else
			{
				$tags = $subtags;
			}
			
			
			
			$tags = array_filter($tags);
			tools::debug($tags);
			$tags_lowcase = array_map('strtolower', $tags);
			
			$tags = array_map('trim', $tags);
			
			$query = 'DELETE FROM tags_ownage WHERE item_id = :item_id AND system = :system';
			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':item_id', $data['item_id']);
			$stmt->bindValue(':system', $data['system']); 
			if(!$stmt->execute())
			{
				tools::debug($stmt->errorInfo());
			}
			
			$query = 'SELECT id, title FROM tags WHERE LOWER(title) IN ("' . implode('", "', $tags_lowcase) . '") AND system = "' . $data['system'] . '"';
			tools::debug($query);
			foreach($_PDO->query($query) AS $row)
			{
				tag::create_relationship(array('tag_id' => $row['id'], 'item_id' => $data['item_id'], 'system' => $data['system']));
				
				$existing_tags[] = strtolower($row['title']);
			}
			tools::debug($existing_tags);
			foreach($tags as $tag)
			{
				if(!in_array(strtolower($tag), $existing_tags))
				{
					// create tag
					$insertid = tag::create_tag($tag, $data['system']);
					
					// add tag to object
					tag::create_relationship(array('tag_id' => $insertid, 'item_id' => $data['item_id'], 'system' => $data['system']));
				}
			}
			tools::debug($tags);
		}
			
		function create_tag($title, $system)
		{
			global $_PDO;
			
			$handle = tools::handle($title);
			for($i = 2; $i < 50; $i++)
			{
				if(tag::fetch(array('handle' => $handle, 'system' => $system)))
				{
					$handle = tools::handle($title) . '-' . $i;
				}
			}
			
			$query = 'INSERT INTO tags (handle, title, system, popularity)';
			$query .= ' VALUES(:handle, :title, :system, :popularity)';
			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':handle', $handle);
			$stmt->bindValue(':title', $title); 
			$stmt->bindValue(':system', $system);
			$stmt->bindValue(':popularity', 0);
			if(!$stmt->execute())
			{
				tools::debug($stmt->errorInfo());
			}
			return $_PDO->lastInsertId();
		}
		
		function create_relationship($data)
		{
			global $_PDO;
			
			$query = 'INSERT INTO tags_ownage (item_id, tag_id, system)';
			$query .= ' VALUES(:item_id, :tag_id, :system)';
			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':item_id', $data['item_id']);
			$stmt->bindValue(':tag_id', $data['tag_id']); 
			$stmt->bindValue(':system', $data['system']);
			if(!$stmt->execute())
			{
				tools::debug($stmt->errorInfo());
			}
		}
		
		function render_form($system, $mastertags, $item_id = NULL)
		{
			global $_PDO;
			// Get all tags
			$query = 'SELECT t.title FROM tags as t WHERE system = :system';

			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':system', $system);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$tags[] = $row['title'];
			}
			
			// Get items tags
			$query = 'SELECT t.title FROM tags as t, tags_ownage as tao WHERE tao.system = :system AND tao.item_id = :item_id AND tao.tag_id = t.id';

			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':system', $system);
			$stmt->bindValue(':item_id', $item_id);
			if(!$stmt->execute())
			{
				tools::debug($stmt->errorInfo());
			}

			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$active_tags[] = $row['title'];
			}
			tools::debug($active_tags);
			
			foreach($active_tags as $active_tag)
			{
				if(in_array($active_tag, $mastertags))
				{
					$active_mastertags[] = $active_tag;
				}
				else
				{
					$active_subtags[] = $active_tag;
				}
			}
			
			return template('tags', 'choose_tags.php', array('tags' => $tags, 'mastertags' => $mastertags, 'active_subtags' => $active_subtags, 'active_mastertags' => $active_mastertags));
		}
		

	}
?>