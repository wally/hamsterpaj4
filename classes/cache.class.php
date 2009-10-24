<?php
	/* 
			The plan is that this cache class should get outdated and we will use Memcache instead
			---
			No, it's not!
			This class should continue to be used, as a wrapper for memcached. This provides portability to systems which lacks memcache.
	*/

	class Cache
	{
		public function load($handle)
		{
			$serialized = file_get_contents(PATH_CACHE . $handle . '.phpserialized');
			return unserialize($serialized);
		}
		
		public function save($handle, $data)
		{
			Cache::cache_save($handle, $data);
		}
		
		public function cache_save($handle, $data)
		{
			$serialized = serialize($data);
			$file = fopen(PATH_CACHE . $handle . '.phpserialized', 'w');
			fwrite($file, $serialized);
			fclose($file);
		}
		
		# This method should not be used. Not at all. Do not use it.
		public function lastUpdate($handle)
		{
			Tools::debug('<span style="color: red; font-weight: bold;">Please use Cache::last_update() instead of Tools::lastUpdate()</span>');
			return filemtime(PATH_CACHE . $handle . '.phpserialized');
		}
		
		# This method provides you cookies
		public function last_update($handle)
		{
			return filemtime(PATH_CACHE . $handle . '.phpserialized');
		}
	}
?>
