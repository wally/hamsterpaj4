<?php
	class Tools
	{
		public static function find_files($dir, $options)
		{
			Tools::pick_inplace($options['recursive'], true);
			Tools::pick_inplace($options['excludes'], array());
			Tools::pick_inplace($options['extension'], false);
			Tools::pick_inplace($options['endswith'], false);
			
			$files = scandir($dir);
			foreach($files AS $key => $file)
			{
				if( $file == '.' || $file == '..' || in_array($dir . $file, $options['excludes']) )
				{
					unset($files[$key]);
					continue;
				}
				$extension = substr($file, strrpos($file, '.') + 1);
				
				if(is_dir($dir . $file))
				{
				    $subfiles = Tools::find_files($dir . $file . '/', $options);
				    foreach($subfiles AS $subfile)
				    {
					    $files[] = $file . '/' . $subfile;
				    }
				    unset($files[$key]);
				}
				elseif ( $options['endswith'] && ! String::endswith($file, $options['endswith']) )
				{
				    unset($files[$key]);
				    continue;
				}
				elseif ( $options['extension'] && $extension != $options['extension'] )
				{
					unset($files[$key]);
					continue;
				}
			}
			return $files;
		}

		public static function fetch_files_from_folder($dir)
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
		
		public static function makePath($in)
		{
		    $pieces = func_get_args();
		    $pieces = array_slice($pieces, 1);
		    
		    switch ( $in )
		    {
			case 'packages':
			    return PATH_PACKAGES . implode(DIRECTORY_SEPARATOR, $pieces);
			break;
		    }
		    
		    throw new Exception('No such path in Tools::makePath');
		}
		
		public static function cute_number($num)
		{
			return strrev(chunk_split(strrev($num), 3, ' '));
		}

		public static function duration_readable($duration)
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

		public static function date_readable($timestamp)
		{
			return date('Y-m-d H:i:s', $timestamp);
		}
		
		public static function preint_r($data)
		{
			$out = '<pre>' . "\n";
			$out .= print_r($data, true);
			$out .= '</pre>' . "\n";
			
			return $out;
		}

		public static function debug($message, $name = null)
		{
			global $_DEBUG;
			$backtrace = debug_backtrace();
			$file = substr($backtrace[0]['file'], strrpos($backtrace[0]['file'], '/')+1);
			$message = (is_string($message)) ? $message : '<pre>' . print_r($message, true) . '</pre>';
			if(isset($backtrace[1]['file']))
			{
				$function_file = substr($backtrace[1]['file'], strrpos($backtrace[1]['file'], '/')+1);
				$message .= '<br /><span class="calling_public static function">Funktionen anropades utav: ' . $function_file . ' #' . $backtrace[1]['line'] . '</span>';
			}
			$_DEBUG[] = array('title' => (is_null($name) ? '' : $name . ': ') . $file . ' #' . $backtrace[0]['line'], 'text' => $message);
			
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
		
		public static function timer($point)
		{
			global $_TIMER;
			$_TIMER[] = array('point' => $point, 'time' => microtime(true));
		}

		public static function handle($string)
		{
			$healthy = array(' ', 'å', 'ä', 'ö');
			$yummy = array('-', 'a', 'a', 'o');
			$string = strtolower(str_replace($healthy, $yummy, $string));
			return preg_replace('/[^a-zA-Z0-9\-\/]/', '', $string);		
		}
		
		public static function file_size_readable($bytes, $precision = 2)
		{
		    $units = array('B', 'KB', 'MB', 'GB', 'TB');
		  
		    $bytes = max($bytes, 0);
		    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
		    $pow = min($pow, count($units) - 1);
		  
		    $bytes /= pow(1024, $pow);
		  
		    return round($bytes, $precision) . ' ' . $units[$pow];
		}
		
		public static function file_download_time($bytes, $type)
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
		
		public static function array_map_multidimensional($func, $arr)
		{
			$newArr = array();
			foreach( $arr as $key => $value )
			{
			        $newArr[ $key ] = ( is_array( $value ) ? Tools::array_map_multidimensional( $func, $value ) : $func( $value ) );
			}
			   return $newArr;
		}
		
		public static function pick(&$test, $else)
		{
		    if ( ! isset($test) )
		    {
			return $else;
		    }
		    return $test;
		}
		
		public static function pick_inplace(&$test, $else)
		{
		    $test = self::pick($test, $else);
		}
		
		public static function ensure_array(&$test)
		{
		    $arr = self::pick($test, array());
		    return is_array($arr) ? $arr : array();
		}
		
		public static function is_true(&$test)
		{
		    return isset($test) && $test;
		}
		
		public static function choose(&$test, $on_true, $on_false)
		{
		    return self::is_true($test) ? $on_true : $on_false;
		}
		
		public static function last($array)
		{
		    return end($array);
		}
	}
?>
