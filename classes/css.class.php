<?php
	class CSS
	{
		/* 	Public function to get stylesheets, returns a url to the stylesheet */
		function get()
		{
			// Get array off css files
			$stylesheets = Tools::fetch_files_from_folder(PATH_CSS);
			
			// If we are in dev environment, DON'T compress css
			if(ENVIRONMENT == 'development')
			{
				return $stylesheets;
			}
			
			// If files arn't updated, load cached merge
			foreach($stylesheets as $stylesheet)
			{
				if(filemtime(PATH_COMPRESSED_CSS . Cache::load('latest_css_merge')) < filemtime(PATH_CSS . $stylesheet))
				{
					$need_update = true;
				}
			}
			
			if($need_update == false)
			{
				return array(0 => Cache::load('latest_css_merge'));
			}
			
			// Load and merge files
			foreach($stylesheets as $stylesheet)
			{
				$merged_file .= CSS::load($stylesheet);
			}
			
			// Compress file
			$compressed_file = CSS::compress($merged_file);

			// Set filename
			$filename = 'merge_' . time() . '.css';
			
			// remove all old files
			foreach(Tools::fetch_files_from_folder(PATH_COMPRESSED_CSS) as $remove_file)
			{
				unlink(PATH_COMPRESSED_CSS . $remove_file);
			}

			// save file
			file_put_contents(PATH_COMPRESSED_CSS . $filename, $compressed_file);
			
			// save filename in cache
			Cache::cache_save('latest_css_merge', $filename);
			
			// return URL
			return array(0 => $filename);
		}
		
		/* Gets the cssfiles data */
		function load($file)
		{
			$data = file_get_contents(PATH_CSS . $file);
			
			return $data;
		}
		
		/* Strips of comments and spaces in css */
		function compress($data)
		{
			// remove comments
	    $data = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $data);
	    
	    // remove tabs, spaces, newlines, etc.
	    $data = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $data);
	    
	    return $data;
		}
	}
?>