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
			return 'http://static.hamsterpaj.net/images/entertain/default_previews/' . $this->category . '_medium.png';
		}
		
		function fetch($search)
		{
			global $_PDO;
			
			$query = 'SELECT * FROM entertain WHERE 1';
			$query .= (isset($search['handle'])) ? ' AND handle = "' . $search['handle'] . '"' : '';
			$query .= (isset($search['type'])) ? ' AND type = "' . $search['type'] . '"' : '';
			$query .= (isset($search['limit'])) ? ' LIMIT ' . $search['limit'] : '';
			
			foreach($_PDO->query($query) AS $row)
			{
				$item = new entertain();				

				$item->id = $row['id'];
				$item->type = $row['type'];
				$item->category = $row['category'];
				$item->title = $row['title'];
				$item->handle = $row['handle'];
				$item->click = $row['click'];
				$item->data = $row['data'];
				$item->has_image = $row['has_image'];
				$item->published_at = $row['published_at'];
				$item->uploaded_by = $row['uploaded_by'];
				
				if($search['allow_multiple'] == true)
				{
					$items[] = $item;
				}
				else
				{
					return $item;
				}
			}
			return $items;
		}

		function __construct()
		{
			$this->published_at = time();
		}
		
		function get_url()
		{
			return '/flash/' . $this->handle;
		}
		
		function set_title($title)
		{
			$this->title = $title;
			if(strlen($this->handle) == 0)
			{
				$this->handle = tools::handle($title);
			}
		}
		
		function save()
		{
			global $_PDO;
			
			if($this->id > 0)
			{
				
			}
			else
			{
				$query = 'INSERT INTO entertain (type, category, title, handle, data, has_image, published_at, uploaded_by)';
				$query .= ' VALUES("' . $this->type . '", "' . $this->category . '", "' . $this->title . '", "' . $this->handle . '"';
				$query .= ', "' . $this->data . '", "' . $this->has_image . '", "' . $this->published_at . '", "' . $this->uploaded_by . '")';
			
				$_PDO->query($query);	
				
			}
			tools::debug('Saving entertain object!');
			tools::debug($this);
		}
	}

?>