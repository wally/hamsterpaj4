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
			$serialized = file_get_contents(PATH_CACHE . $handle . '.phpserialized');
			return unserialize($serialized);
		}
		
		public function save($handle, $data)
		{
			cache::cache_save($handle, $data);
		}
		
		public function cache_save($handle, $data)
		{
			$serialized = serialize($data);
			$file = fopen(PATH_CACHE . $handle . '.phpserialized', 'w');
			fwrite($file, $serialized);
			fclose($file);
		}
		
		public function lastUpdate($handle)
		{
			return filemtime(PATHS_CACHE . $handle . '.phpserialized');
		}
	}
?>