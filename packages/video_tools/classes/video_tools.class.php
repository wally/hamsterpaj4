<?php
	class video_tools
	{
		function generate_preview($flvfile, $location)
		{
	 		$cmd = 'sh ' . PATH_PACKAGES . 'video_tools/shellscripts/generate_preview.sh ' . $flvfile . ' 00:00:01 ' . $location;
	 		tools::debug($cmd);
	 		shell_exec($cmd);
		}
		
		function convert_to_flv($infile, $outfile, $quality = NULL)
		{
			switch($quality)
			{
				case 'high':
					$new_width = 628;
				break;
				
				default:
					$new_width = 314;
				break;
			}
			tools::debug($infile);
			// Get size of video
			$info_output = shell_exec('/usr/bin/ffmpeg -i ' . $infile . ' 2>&1');
			$info = explode(':', $info_output); 
			$info[17] = explode(',', $info[17]); 
			$info[17][2] = explode('[', $info[17][2]); 
			$size = str_replace(' ', '', $info[17][2][0]);
			$size = explode('x', $size); 
			
			// Set new size
			$width = $size[0];
			tools::debug('width=' . $width);
			$height = $size[1];
			tools::debug($height);
			$aspect_ratio = $width/$height;
			$new_height = round($new_width/$aspect_ratio, 0);
			$new_height = $new_height&1 ?  $new_height+1 : $new_height;
			tools::debug('width=' . $width);
			tools::debug('ffmpeg -i ' . $infile . ' -deinterlace -ar 44100 -r 25 -qmin 1 -qmax 3 -size ' . $new_width . 'x' . $new_height . ' ' . $outfile . ' > /dev/null');
			// Convert
			system('ffmpeg -i ' . $infile . ' -deinterlace -ar 44100 -r 25 -qmin 1 -qmax 3 -s ' . $new_width . 'x' . $new_height . ' ' . $outfile . ' > /dev/null');
		}
	}
?>