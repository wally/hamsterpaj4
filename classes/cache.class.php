<?php
	/* 
			The plan is that this cache class should get outdated and we will use Memcache instead
			---
			No, it's not!
			This class should continue to be used, as a wrapper for memcached. This provides portability to systems which lacks memcache.
	*/

	class Cache
	{
		public static function load($handle)
		{
			$serialized = file_get_contents(PATH_CACHE . $handle . '.phpserialized');
			return unserialize($serialized);
		}
		
		public static function get_name($handle)
		{
		    return PATH_CACHE . $handle . '.phpserialized';
		}
		
		public static function save($handle, $data, $serialize = true)
		{
			Cache::cache_save($handle, $data, $serialize);
		}
		
		public static function cache_save($handle, $data, $serialize = true)
		{
			$serialized = ($serialize) ? serialize($data) : $data;
			$file = fopen(PATH_CACHE . $handle . '.phpserialized', 'w');
			fwrite($file, $serialized);
			fclose($file);
		}
		
		# This method should not be used. Not at all. Do not use it.
		public static function lastUpdate($handle)
		{
			Tools::debug('<span style="color: red; font-weight: bold;">Please use Cache::last_update() instead of Tools::lastUpdate()</span>');
			return filemtime(PATH_CACHE . $handle . '.phpserialized');
		}
		
		# This method provides you cookies
		public static function last_update($handle)
		{
			return filemtime(PATH_CACHE . $handle . '.phpserialized');
		}
	}
?>
