<?php
	class tools
	{
		function time_readable($duration)
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
		
		function preint_r($data)
		{
			$out = '<pre>' . "\n";
			$out .= print_r($data, true);
			$out .= '</pre>' . "\n";
			
			return $out;
		}
	}
?>