<?php
	class PageEntertainLoadOld extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/entertain-load') ? 10 : 0;
		}
		
		function execute($uri)
		{
			/*$search = array('allow_multiple' => true, 'type' => 'image', 'status' => 'queue');
			$items = Entertain::Fetch($search);
			$i = 0;
			foreach($items as $item)
			{
				if(!file_exists('/mnt/static/entertain/images/' . $item->handle . '.jpg'))
				{
					$i++;
					$item->remove();
				}
			}
			$this->content .= $i;
			*/
			
			/*
			global $_PDO;

			$query = 'SELECT * FROM entertain_items WHERE entertain_type = "image"';

			$stmt = $_PDO->prepare($query);
			$stmt->execute();
			
			$items = array();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				//$this->content .= '/mnt/amuse/distribute/image/' . $row['handle'] . '.jpg';
				
				$item = new Entertain;
				$item->set(array('type' => 'image'));
				$item->set(array('title' => $row['title']));				
				$item->set(array('category' => 'roliga_bilder'));		
				$item->set(array('status' => 'queue'));	
				$item->set(array('uploaded_by' => 2348));		
				$item->save();
				
				copy('/mnt/amuse/distribute/image/' . $row['handle'] . '.jpg', '/mnt/static/entertain/images/' . $item->handle . '.jpg');
			}
			*/
		}
	}