<?php
	/* 
			The plan is that this cache class should get outdated and we will use Memcache instead
	*/
	class cache
	{
		public function load($handle)
		{
			if(!$serialized = file_get_contents(PATH_CACHE . $handle . '.phpserialized')) throw new Exception('Cache file "' . $handle . '.phpserialized" could not be opened');
			return unserialize($serialized);
		}
		
		public function lastUpdate($handle)
		{
			return filemtime(PATHS_CACHE . $handle . '.phpserialized');
		}
	}
?>