<?php
	
	class livesearch
	{
		function search($search_query)
		{	
			$items = livesearch::fetch_entertain($search_query);
			
			$items = array_merge($items, livesearch::fetch_users($search_query));
			
			foreach($items as $item)
			{
				
				$categories[tools::handle($item['category_name'])][] = $item;
			}

			return $categories;
		}
		
		function fetch_entertain($search_query)
		{
			global $_PDO;
			$query = 'SELECT title, id, category, handle FROM entertain WHERE status = "released" AND title LIKE "%' . $search_query . '%" LIMIT 5';

			$stmt = $_PDO->prepare($query);
				
			$items = array();
			if($stmt->execute())
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$item['category_name'] = entertain::get_category_label($row['category']);
					$item['item_name'] = $row['title'];
					$item['item_url'] = '/' . $row['category'] . '/' . $row['handle'];
					$items[] = $item;
				}
			}
			
			return $items;
		}
		
		function fetch_users($search_query)
		{
			global $_PDO;
			$query = 'SELECT id, username FROM login WHERE is_removed = "0" AND username LIKE "%' . $search_query . '%" LIMIT 5';

			$stmt = $_PDO->prepare($query);
			
			$items = array();
			if($stmt->execute())
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$item['category_name'] = 'Användare';
					$item['item_name'] = $row['username'];
					$item['item_url'] = '/traffa/profile.php?id=' . $row['id'];
					$items[] = $item;
				}
			}
			
			return $items;
		}
	}

?>