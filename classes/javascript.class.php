<?php
	class javascript
	{
		/* 	Public function to get stylesheets, returns a url to the stylesheet */
		function get()
		{
			// Get array off css files
			$javascripts = tools::fetch_files_from_folder(PATH_JAVASCRIPTS);

			// If we are in dev environment, DON'T compress css
			if(ENVIRONMENT == 'development')
			{
				//return $javascripts;
			}
			
			// If files arn't updated, load cached merge
			foreach($javascripts as $javascript)
			{
				if(filemtime(PATH_COMPRESSED_JAVASCRIPTS . cache::load('latest_javascript_merge')) < filemtime(PATH_JAVASCRIPTS . $javascript))
				{
					$need_update = true;
				}
			}
			
			if($need_update == false)
			{
				//return array(0 => cache::load('latest_javascript_merge'));
			}
			
			// Load and merge files
			foreach($javascripts as $javascript)
			{
				$merged_file .= javascript::load($javascript);
			}
			
			// Compress file
			$compressed_file = javascript::compress($merged_file);

			// Set filename
			$filename = 'merge_' . time() . '.js';
			
			// remove all old files
			foreach(tools::fetch_files_from_folder(PATH_COMPRESSED_JAVASCRIPTS) as $remove_file)
			{
				if(!$remove_file == 'merged.js') // merged.js is used in old framework
				{
					unlink(PATH_COMPRESSED_JAVASCRIPTS . $remove_file);
				}
			}

			// save file
			file_put_contents(PATH_COMPRESSED_JAVASCRIPTS . $filename, $compressed_file);
			
			// save filename in cache
			cache::cache_save('latest_javascript_merge', $filename);
			
			// return URL
			return array(0 => $filename);
		}
		
		/* Gets the javascriptfiles data */
		function load($file)
		{
			$data = file_get_contents(PATH_JAVASCRIPTS . $file);
			
			return $data;
		}
		
		/* Strips of comments and spaces in js */
		function compress($data)
		{
			$data = JSMin::minify($data);
			// remove comments
	    //$data = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $data);
	    
	    // remove tabs, spaces, newlines, etc.
	   // $data = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $data);
	    
	    return $data;
		}
	}
?>