<?php

	class entertain extends hp4
	{
		function preview_full()
		{
			return template('entertain/preview_full.php', array('item' => $this));
		}
		
		function previews($items)
		{
			return template('pages/entertain/previews.php', array('items' => $items));
		}
		
		function display()
		{
			switch ($this->type) {
				case 'flash':
					return template('pages/entertain/flash.php', array('item' => $this));
					break;
				case 'web':
					
					break;
				case 'text':
					
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
			tools::debug($this);
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