<?php
	class PageEntertainLoadOld extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/entertain-load') ? 10 : 0;
		}
		
		function execute($uri)
		{
			/*
			
			global $_PDO;

			$query = 'SELECT * FROM entertain_items WHERE entertain_type = "flash"';

			$stmt = $_PDO->prepare($query);
			$stmt->execute();
			
			$items = array();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				//$this->content .= '/mnt/amuse/distribute/flash/' . $row['handle'] . '.jpg';
				
				$item = new Entertain;
				$item->set(array('type' => 'video'));
				$item->set(array('title' => $row['title']));				
				$item->set(array('category' => 'animerat'));		
				$item->set(array('status' => 'queue'));	
				$item->set(array('uploaded_by' => 2348));		
				
				if(file_exists('/mnt/amuse/distribute/flash/' . $row['handle'] . '.flv'))
				{
					$this->content .= Tools::preint_r($item);;
					//$item->save();
					// $this->content .= '/mnt/amuse/distribute/flash/' . $row['handle'] . '.swf';
					//copy('/mnt/amuse/distribute/flash/' . $row['handle'] . '.flv', '/mnt/static/entertain/video/' . $item->handle . '.flv');
				}
			}
			*/
		}
	}