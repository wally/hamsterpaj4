<?php
	class EntertainVideo extends Entertain
	{
		function render()
		{
			Tools::debug($this);
			return template('entertain', 'views/video.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{
			switch($_POST['video_action'])
			{
				case 'wget':
					// Remove old files
					unlink('/mnt/static/entertain/video/' . $this->handle . '.flv');
					unlink('/mnt/static/entertain/video/' . $this->handle . '.mp4');
					unlink('/mnt/static/entertain/video/' . $this->handle . '.jpg');
					$file_extension = end(explode(".", $_POST['video_url']));
					
					if($file_extension == 'flv')
					{
					 $cmd = 'wget ' . escapeshellarg($_POST['video_url']) . ' -O /mnt/static/entertain/video/' . $this->handle . '.flv';
					}
					else
					{
						$cmd = 'wget ' . escapeshellarg($_POST['video_url']) . ' -O /mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension;
						shell_exec($cmd);
					
						VideoTools::convert_to_flv('/mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension, '/mnt/static/entertain/video/' . $this->handle . '.flv', 'high');
					
						shell_exec('rm /mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension);
					}
		
					$this->data['file'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.flv';
					$this->data['preview'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.jpg';
					VideoTools::generate_preview('/mnt/static/entertain/video/' . $this->handle . '.flv', '/mnt/static/entertain/video/' . $this->handle . '.jpg');
				break;
				case 'upload':
					// Remove old files
					unlink('/mnt/static/entertain/video/' . $this->handle . '.flv');
					unlink('/mnt/static/entertain/video/' . $this->handle . '.mp4');
					unlink('/mnt/static/entertain/video/' . $this->handle . '.jpg');
					$file_extension = end(explode(".", $_FILES['video_upload']['name']));
					
					if($file_extension == 'flv')
          {
						move_uploaded_file($_FILES['video_upload']['tmp_name'], '/mnt/static/entertain/video/' . $this->handle . '.flv');
          }
          else
          {
						move_uploaded_file($_FILES['video_upload']['tmp_name'], '/mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension);
					
						VideoTools::convert_to_flv('/mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension, '/mnt/static/entertain/video/' . $this->handle . '.flv', 'high');
					
						shell_exec('rm /mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension);
					}
					$this->data['preview'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.jpg';
					$this->data['file'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.flv';
					VideoTools::generate_preview('/mnt/static/entertain/video/' . $this->handle . '.flv', '/mnt/static/entertain/video/' . $this->handle . '.jpg');
				break;
				case 'youtube':		
					// Remove old files
					unlink('/mnt/static/entertain/video/' . $this->handle . '.flv');
					unlink('/mnt/static/entertain/video/' . $this->handle . '.mp4');
					unlink('/mnt/static/entertain/video/' . $this->handle . '.jpg');			
					$youtube_page = @file_get_contents($_POST['youtube_url']);

				  preg_match('#\'SWF_ARGS\': {(.*?)}#', $youtube_page, $fullscreen_url);
				  $fullscreen_url = $fullscreen_url[1] . '&' ;
					Tools::debug($fullscreen_url);
				  preg_match('#"video_id": "([a-z0-9-_]+)"#i', $fullscreen_url, $video_id);
				  $video_id = $video_id[1];

				  preg_match('#"l": ([0-9]+),#i', $fullscreen_url, $l);
				  $l = $l[1];
	
				  preg_match('#"t": "(.*?)"#i', $fullscreen_url, $t);
				  $t = $t[1];

          preg_match('#"fmt_map": "(.*?)(/|%)#i', $fullscreen_url, $fmt);
          $fmt = $fmt[1];

					// MP4
					shell_exec('rm /mnt/static/entertain/video/' . $this->handle . '.mp4');

					if(strlen($fmt) >= 1)
					{
          	$mp4_url = 'http://www.youtube.com/get_video?video_id=' . $video_id . '&l=' . $l . '&t=' . $t . '&fmt=' . $fmt;
         	 $cmd = '/usr/bin/wget --read-timeout=0.4 ' . escapeshellarg($mp4_url) . ' -O /mnt/static/entertain/video/' . $this->handle . '.mp4';
          	Tools::debug($cmd);
						shell_exec($cmd);
					}
					
					// FLASH
					$flash_url = 'http://www.youtube.com/get_video?video_id=' . $video_id . '&l=' . $l . '&t=' . $t;

          $cmd = '/usr/bin/wget --read-timeout=0.4 ' . escapeshellarg($flash_url) . ' -O /mnt/static/entertain/video/' . $this->handle . '.flv';
          Tools::debug($cmd);
          shell_exec($cmd);
          
          
          $this->data['file'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.flv';
          $this->data['preview'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.jpg';
          VideoTools::generate_preview('/mnt/static/entertain/video/' . $this->handle . '.flv', '/mnt/static/entertain/video/' . $this->handle . '.jpg');
					
				break;
			}
			Tools::debug('Updating from post!');
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/video.php', array('item' => $this, 'data' => $this->get('data')));
		}
	}
?>
