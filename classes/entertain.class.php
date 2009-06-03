<?php

	class entertain extends hp4
	{
	
		function preview_full()
		{
			return template('entertain/preview_full.php', array('item' => $this));
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