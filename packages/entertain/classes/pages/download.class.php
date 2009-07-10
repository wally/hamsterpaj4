<?php
	class page_entertain_download extends page
	{
		function url_hook($uri)
		{
			foreach(array('flash', 'onlinespel', 'bilder', 'filmklipp', 'spel', 'webb', 'ascii') as $i)
			{
				if(substr($uri, 1, strlen($i)) == $i && strlen($uri) > strlen($i)+2 && substr($uri, -9) == 'ladda_ner')
				{
					return 20;
				}
			}
			return 0;
		}
		
		function execute($uri)
		{
			$uri_explode = explode('/', $uri);
			if(!$item = entertain::fetch(array('handle' => $uri_explode[2])))
			{
				$this->content .= template(NULL, 'framework/notifications/not_found.php', array('header' => 'Item not found', 'information' => 'The sought object could not be found'));
				return;
			}
			
			if($item->get('type') != 'file')
			{
				$this->content .= template(NULL, 'framework/notifications/not_found.php', array('header' => 'Ej möjligt att ladda ner', 'information' => 'Du kan endast ladda ner filer från vår nedladdningssektion.'));
				return;					}
	
			
			if(!isset($_POST['truesubmit']))
			{
				header('Location: ' . $item->get('url'));
			}
			
			$data = $item->get('data');
			
			$file = PATH_STATIC . 'entertain/files/' . $data['filename'];
			if (file_exists($file)) {
				header('Content-Description: File Transfer');
				header('Content-Type: ' . $data['type']);
				header('Content-Disposition: attachment; filename=' . $data['filename']);
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
				exit;
			}
			else
			{
				tools::debug('No file found');
			}
			
			$this->content = 'lol';
		}
	}
?>