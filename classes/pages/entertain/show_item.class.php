<?php
	
	class page_entertain_item extends page
	{
		function url_hook($uri)
		{
			foreach(array('flash', 'onlinespel', 'bilder', 'filmklipp', 'spel', 'webb', 'ascii') as $i)
			{
				if(substr($uri, 1, strlen($i)) == $i && strlen($uri) > strlen($i)+2)
				{
					return 10;
				}
			}
			return 0;
		}
		
		function execute($uri)
		{
			$game = new entertain();
			$game->set(array('type' => 'flash'));
			$game->set(array('name' => 'Bloons Tower Defense 3'));
			$game->set(array('url' => 'http://amuse.hamsterpaj.net/distribute/game/learn_to_fly.swf'));
			$game->set(array('class' => 'onlinegame'));
			
			$uri_explode = explode('/', $uri);
			
			$item = new entertain();
			$item->fetch($uri_explode[2]);
			
			$this->content = $item->render();
		}
	}

?>