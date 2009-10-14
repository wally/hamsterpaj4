<?php
	class Tools
	{
		function find_files($dir, $options)
		{
			Tools::pick_inplace($options['recursive'], true);
			
			$files = scandir($dir);
			foreach($files AS $key => $file)
			{
				$extension = substr($file, strrpos($file, '.') + 1);
				if($file == '.' || $file == '..')
				{
					unset($files[$key]);
					continue;
				}
				
				if(is_dir($dir . $file))
		    {
		    	$subfiles = Tools::find_files($dir . $file . '/', $options);
		    	foreach($subfiles AS $subfile)
		    	{
		    		$files[] = $file . '/' . $subfile;
		    	}
		    	unset($files[$key]);
		    }
				elseif(isset($options['extension']) && $extension != $options['extension'])
				{
					unset($files[$key]);
					continue;
				}
			}
			return $files;
		}

		function fetch_files_from_folder($dir)
		{
			$files = scandir($dir);
			foreach($files as $key => $file)
			{
				if($file == '.' || $file == '..')
				{
					unset($files[$key]);
				}
				if(is_dir($dir . $file) && $file != '.' && $file != '..')
		    {
		    	$subfiles = Tools::fetch_files_from_folder($dir . $file . '/');
		    	foreach($subfiles as $subfile)
		    	{
		    		array_push($files, $file . '/' . $subfile);
		    	}
		    	unset($files[$key]);
		    }
			}
			return $files;
		}
		
		function cute_number($num)
		{
			return strrev(chunk_split(strrev($num), 3, ' '));
		}
		
		function time_readable($duration)
		{
			Tools::debug('Call to deprecated time_readable(). Please use date_readable() or duration_readable() instead');
			$days = floor($duration/86400);
			$hrs = floor(($duration - $days * 86400) / 3600);
			$min = floor(($duration - $days * 86400 - $hrs * 3600) / 60);
			$s = $duration - $days * 86400 - $hrs * 3600 - $min * 60;
			
			$return = ($days > 0) ? $days . ' d ' : '';
			$return .= ($days > 0 || $hrs > 0) ? $hrs . ' tim ' : '';
			$return .= ($days > 0 || $hrs > 0 || $min > 0) ? $min . ' min ' : '';
			$return .= ($days > 0 || $hrs > 0 || $min > 0) ? $s . ' s ' : '';

			return $return;
		}

		function duration_readable($duration)
		{
			$days = floor($duration/86400);
			$hrs = floor(($duration - $days * 86400) / 3600);
			$min = floor(($duration - $days * 86400 - $hrs * 3600) / 60);
			$s = $duration - $days * 86400 - $hrs * 3600 - $min * 60;
			
			$return = ($days > 0) ? $days . ' d ' : '';
			$return .= ($days > 0 || $hrs > 0) ? $hrs . ' tim ' : '';
			$return .= ($days > 0 || $hrs > 0 || $min > 0) ? $min . ' min ' : '';
			$return .= ($days > 0 || $hrs > 0 || $min > 0 || $s > 0) ? $s . ' s ' : '';
			$return .= ($duration == 0) ? 'ingen' : '';

			return $return;
		}

		function date_readable($timestamp)
		{
			return date('Y-m-d H:i:s', $timestamp);
		}
		
		function preint_r($data)
		{
			$out = '<pre>' . "\n";
			$out .= print_r($data, true);
			$out .= '</pre>' . "\n";
			
			return $out;
		}

		function debug($message)
		{
			global $_DEBUG;
			$backtrace = debug_backtrace();
			$file = substr($backtrace[0]['file'], strrpos($backtrace[0]['file'], '/')+1);
			$message = (is_string($message)) ? $message : '<pre>' . print_r($message, true) . '</pre>';
			if(isset($backtrace[1]['file']))
			{
				$function_file = substr($backtrace[1]['file'], strrpos($backtrace[1]['file'], '/')+1);
				$message .= '<br /><span class="calling_function">Funktionen anropades utav: ' . $function_file . ' #' . $backtrace[1]['line'] . '</span>';
			}
			$_DEBUG[] = array('title' => $file . ' #' . $backtrace[0]['line'], 'text' => $message);
			
			$log = date('Y-m-d H:i:s') . "\t"; 
			$log .= $file . "\n";
			$log .= (is_string($message)) ? $message : print_r($message, true);
			$log .= "\n\n\n";
			$filename = PATH_DEBUG . date('Y-m-d') . '.log';
			if ( ! file_exists($filename) )
			{
			    fclose(fopen($filename, 'x'));
			}
			file_put_contents($filename, $log, FILE_APPEND);
		}
		
		function timer($point)
		{
			global $_TIMER;
			$_TIMER[] = array('point' => $point, 'time' => microtime(true));
		}

		function handle($string)
		{
			$healthy = array(' ', 'å', 'ä', 'ö');
			$yummy = array('-', 'a', 'a', 'o');
			$string = strtolower(str_replace($healthy, $yummy, $string));
			return preg_replace('/[^a-zA-Z0-9\-\/]/', '', $string);		
		}
		
		function array_pop_key($array, $key)
		{
			return $array[$key];
		}
		
		function file_size_readable($bytes, $precision = 2)
		{
	    $units = array('B', 'KB', 'MB', 'GB', 'TB');
	  
	    $bytes = max($bytes, 0);
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	    $pow = min($pow, count($units) - 1);
	  
	    $bytes /= pow(1024, $pow);
	  
	    return round($bytes, $precision) . ' ' . $units[$pow];
		}
		
		function file_download_time($bytes, $type)
		{
			switch($type)
			{
				case 'adsl':
					$sec = $bytes/700000;
				break;
				
				case '3g':
					$sec = $bytes/200000;
				break;
				
				case 'fiber':
					$sec = $bytes/10000000;
				break;
			}
			
			return round($sec, 0);
		}
		
		function array_map_multidimensional($func, $arr)
		{
			$newArr = array();
			foreach( $arr as $key => $value )
			{
			        $newArr[ $key ] = ( is_array( $value ) ? Tools::array_map_multidimensional( $func, $value ) : $func( $value ) );
			}
			   return $newArr;
		}
		
		static function pick(&$test, $else)
		{
		    if ( ! isset($test) )
		    {
			return $else;
		    }
		    return $test;
		}
		
		static function pick_inplace(&$test, $else)
		{
		    $test = self::pick($test, $else);
		}
		
		static function ensure_array(&$test)
		{
		    return self::pick($test, array());
		}
		
		static function is_true(&$test)
		{
		    return isset($test) && $test;
		}
		
		static function choose(&$test, $on_true, $on_false)
		{
		    return self::is_true($test) ? $on_true : $on_false;
		}
	}
?>
