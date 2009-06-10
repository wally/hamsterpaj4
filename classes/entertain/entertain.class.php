<?php

	class entertain extends hp4
	{
		function preview_full()
		{
			return template('entertain/preview_full.php', array('item' => $this));
		}
		
		function previews($items)
		{
			return template('entertain/previews.php', array('items' => $items));
		}
		
		function categories()
		{
			$categories[] = array('handle' => 'onlinespel', 'label' => 'Onlinespel');
			$categories[] = array('handle' => 'flash', 'label' => 'Flashfilmer');
			$categories[] = array('handle' => 'free_music', 'label' => 'Gratis musik');
			$categories[] = array('handle' => 'ascii', 'label' => 'ASCII-konst');

			return $categories;
		}
		
		function set_data($data)
		{
			switch($this->type)
			{
				case 'flash':
					return template('entertain/views/flash.php', array('item' => $this));
					break;
				case 'web':
					return template('entertain/views/web.php', array('item' => $this));
					break;
				case 'iframe':
					return template('entertain/views/iframe.php', array('item' => $this));
					break;
				case 'html':
					return template('entertain/views/html.php', array('item' => $this));
					break;
				case 'text':
					tools::debug($data);
					$this->data['text'] = $data['text'];
					$this->data['allow_html'] = $data['allow_html'];
					break;
				case 'preformatted':
					tools::debug($data);
					$this->data['text'] = $data['text'];
					$this->data['allow_html'] = $data['allow_html'];
					break;
				case 'file':
					return template('entertain/views/file.php', array('item' => $this));
					break;
				case 'image':
					return template('entertain/views/image.php', array('item' => $this));
					break;
				case 'mp3':
					return template('entertain/views/mp3.php', array('item' => $this));
					break;
				default:
					tools::debug('Fatal error, no entertain type set.');
					break;
			}
		}
		
		function render()
		{
			switch ($this->type) {
				case 'flash':
					return template('entertain/views/flash.php', array('item' => $this));
					break;
				case 'web':
					return template('entertain/views/web.php', array('item' => $this));
					break;
				case 'iframe':
					return template('entertain/views/iframe.php', array('item' => $this));
					break;
				case 'html':
					return template('entertain/views/html.php', array('item' => $this));
					break;
				case 'text':
					return template('entertain/views/text.php', array('item' => $this));
					break;
				case 'preformatted':
					return template('entertain/views/preformatted.php', array('item' => $this));
					break;
				case 'file':
					return template('entertain/views/file.php', array('item' => $this));
					break;
				case 'image':
					return template('entertain/views/image.php', array('item' => $this));
					break;
				case 'mp3':
					return template('entertain/views/mp3.php', array('item' => $this));
					break;
				default:
					tools::debug('Fatal error, no entertain type set.');
					break;
			}
		}
		
		function preview_image($dimension)
		{
			if($this->has_image == true)
			{
				return 'http://static.hamsterpaj.net/images/entertain/items/' . $this->handle . '/medium.png';
			}
			return 'http://static.hamsterpaj.net/images/entertain/default_previews/' . $this->category . '_medium.png';
		}
		
		function fetch($search)
		{
			global $_PDO;
			
			$query = 'SELECT * FROM entertain WHERE 1';
			$query .= (isset($search['handle'])) ? ' AND handle = "' . $search['handle'] . '"' : null;
			$query .= (isset($search['type'])) ? ' AND type = "' . $search['type'] . '"' : null;
			$query .= (isset($search['category'])) ? ' AND category = "' . $search['category'] . '"' : null;
			$query .= (isset($search['limit'])) ? ' LIMIT ' . $search['limit'] : null;
			
			foreach($_PDO->query($query) AS $row)
			{
				if(class_exists('entertain_' . $row['type']))
				{
					$class = 'entertain_' . $row['type'];
					$item = new $class();
				}
				else
				{
					 $item = new entertain();				
				}
				
				$item->id = $row['id'];
				$item->type = $row['type'];
				$item->category = $row['category'];
				$item->title = $row['title'];
				$item->handle = $row['handle'];
				$item->click = $row['click'];
				$item->set(array('data' =>unserialize($row['data'])));
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
		
		function get_url()
		{
			return '/flash/' . $this->handle;
		}
		
		function get_data_edit_template()
		{
			return 'entertain/data_edit/text.php';
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
				$stmt->bindValue(':type', $this->title); 
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