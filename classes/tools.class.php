<?php
	class tools
	{
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
		    	$subfiles = tools::fetch_files_from_folder($dir . $file . '/');
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
			tools::debug('Call to deprecated time_readable(). Please use date_readable() or duration_readable() instead');
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
			$return .= ($days > 0 || $hrs > 0 || $min > 0) ? $s . ' s ' : '';

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
			$_DEBUG[] = array('title' => $file . ' #' . $backtrace[0]['line'], 'text' => $message);
			
			$log = date('Y-m-d H:i:s') . "\t"; 
			$log .= $file . "\n";
			$log .= (is_string($message)) ? $message : print_r($message, true);
			$log .= "\n\n\n";
			file_put_contents(PATH_DEBUG . date('Y-m-d') . '.log', $log, FILE_APPEND);			
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
		
	}
?>