<?php
	/* 
			The plan is that this cache class should get outdated and we will use Memcache instead
			---
			No, it's not!
			This class should continue to be used, as a wrapper for memcached. This provides portability to systems which lacks memcache.
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