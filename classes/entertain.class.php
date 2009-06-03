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
		
		function fetch($handle)
		{
			global $_PDO;
			$stmt = $_PDO->prepare('SELECT * FROM entertain WHERE handle = :handle');
			$stmt->bindParam(':handle', $handle, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
			$this->id = $result['id'];
			$this->type = $result['type'];
			$this->category = $result['category'];
			$this->title = $result['title'];
			$this->handle = $result['handle'];
			$this->click = $result['click'];
			$this->data = $result['data'];
			$this->has_image = $result['has_image'];
			$this->published_at = $result['published_at'];
			$this->uploaded_by = $result['uploaded_by'];
		}

		function __construct()
		{
			$this->published_at = time();
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