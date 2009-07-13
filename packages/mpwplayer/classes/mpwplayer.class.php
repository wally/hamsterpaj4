<?php
	class mpwplayer
	{
		function generate_preview($flvfile, $location)
		{
	 		$cmd = 'sh ' . PATH_PACKAGES . 'mpwplayer/shellscripts/generate_preview.sh ' . $flvfile . ' 00:00:01 ' . $location;
	 		tools::debug($cmd);
	 		shell_exec($cmd);
		}
	}
?>