<?php
	# This is simply a base entertain class, to be extended by
	# differend data types, such as entertain_text and entertain_image
	
	class entertain extends hp4
	{
		function preview_full()
		{
			return template('entertain', 'preview_full.php', array('item' => $this));
		}
		
		function previews($items)
		{
			return template('entertain', 'previews.php', array('items' => $items));
		}
		
		function categories()
		{
			# Move away from here
			$categories[] = array('handle' => 'onlinespel', 'label' => 'Onlinespel');
			$categories[] = array('handle' => 'flash', 'label' => 'Flashfilmer');
			$categories[] = array('handle' => 'free_music', 'label' => 'Gratis musik');
			$categories[] = array('handle' => 'funny_images', 'label' => 'Roliga bilder');
			$categories[] = array('handle' => 'ascii', 'label' => 'ASCII-konst');

			return $categories;
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/text.php', array('item' => $this));
		}
		
		function render()
		{
			tools::debug('Render called on generic entertain class!');
		}
		
		function preview_image($dimension)
		{
			$dimension = (in_array($dimension, array('full', 'medium'))) ? $dimension : 'medium';
			if($this->has_image == true)
			{
				return 'http://static.hamsterpaj.net/images/entertain/items/' . $this->handle . '/' . $dimension . '.png';
			}
			return 'http://static.hamsterpaj.net/images/entertain/default_previews/' . $this->category . '_' . $dimension . '.png';
		}
		
		function fetch($search)
		{
			global $_PDO;
			tools::debug($search);		
			$query = 'SELECT * FROM entertain WHERE 1';
			$query .= (isset($search['handle'])) ? ' AND handle = :handle' : null;
			$query .= (isset($search['type'])) ? ' AND type = :type' : null;
			$query .= (isset($search['category'])) ? ' AND category = :category' : null;
			$query .= (isset($search['limit'])) ? ' LIMIT :limit' : null;
			
			$stmt = $_PDO->prepare($query);
			(isset($search['handle'])) ? $stmt->bindValue(':handle', $search['handle']) : null;
			(isset($search['type'])) ? $stmt->bindValue(':type', $search['type']) : null;
			(isset($search['category'])) ? $stmt->bindValue(':category', $search['category']) : null;
			(isset($search['limit'])) ? $stmt->bindValue(':limit', $search['limit'], PDO::PARAM_INT) : null;
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if(class_exists('entertain_' . $row['type']))
				{
					$class = 'entertain_' . $row['type'];
					$item = new $class();
				}
				else
				{
					tools::debug('ERROR: Class entertain_' . $row['type'] . ' does not exist!');
					 $item = new entertain();				
				}
				
				$item->id = $row['id'];
				$item->type = $row['type'];
				$item->category = $row['category'];
				$item->title = $row['title'];
				$item->handle = $row['handle'];
				$item->click = $row['click'];
				$item->data = unserialize($row['data']);
				$item->has_image = $row['has_image'];
				$item->published_at = $row['published_at'];
				$item->uploaded_by = $row['uploaded_by'];
				$item->active = $row['active'];
				
				if($search['allow_multiple'] == true)
				{
					$items[] = $item;
				}
				else
				{
					return $item;
				}
			}
			if($search['allow_multiple'])
			{
				return $items;
			}
			return false;
		}

		function __construct()
		{
			$this->published_at = time();
			$this->active = 0;
		}
		
		function update_from_post()
		{
			$this->set(array('title' => $_POST['title']));
			$this->set(array('category' => $_POST['category']));
			$this->set(array('has_image' => $_POST['has_image']));
			$this->update_data_from_post();
		}
		
		function get_url()
		{
			return '/' . $this->category . '/' . $this->handle;
		}
		
		function set_title($title)
		{
			$this->title = $title;
			if(strlen($this->handle) == 0)
			{
				$handle = tools::handle($title);
				for($i = 2; $i < 50; $i++)
				{
					if(entertain::fetch(array('handle' => $handle)))
					{
						$handle = tools::handle($title) . '-' . $i;
					}
					else
					{
						$this->handle = $handle;
						return true;
					}
				}
			}
		}
		
		function save()
		{
			global $_PDO;
			
			if($this->id > 0)
			{
				$query = 'UPDATE entertain SET title = :title, data = :data, category = :category, has_image = :has_image WHERE id = :id LIMIT 1';
				
				$stmt = $_PDO->prepare($query);
				$stmt->bindValue(':title', $this->title); 
				$stmt->bindValue(':data', serialize($this->data));
				$stmt->bindValue(':category', $this->category);
				$stmt->bindValue(':has_image', $this->has_image);
				$stmt->bindValue(':id', $this->id);
				$stmt->execute();
			}
			else
			{
				$query = 'INSERT INTO entertain (type, category, title, handle, data, has_image, published_at, uploaded_by, active)';
				$query .= ' VALUES(:type, :category, :title, :handle, :data, :has_image, :published_at, :uploaded_by, :active)';

				$stmt = $_PDO->prepare($query);
				$stmt->bindValue(':type', $this->type); 
				$stmt->bindValue(':category', $this->category);
				$stmt->bindValue(':title', $this->title);
				$stmt->bindValue(':handle', $this->handle);
				$stmt->bindValue(':data', serialize($this->data));
				$stmt->bindValue(':has_image', $this->has_image);
				$stmt->bindValue(':published_at', $this->published_at);
				$stmt->bindValue(':uploaded_by', $this->uploaded_by);
				$stmt->bindValue(':active', $this->active);
				if(!$stmt->execute())
				{
					tools::debug($stmt->errorInfo());
				}
			}
		}
	}

?>