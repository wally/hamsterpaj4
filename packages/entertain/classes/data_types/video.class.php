<?php
	class entertain_video extends entertain
	{
		function render()
		{
			tools::debug($this);
			return template('entertain', 'views/video.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{
			switch($_POST['video_action'])
			{
				case 'wget':
					$file_extension = end(explode(".", $_POST['video_url']));
					$cmd = 'wget ' . escapeshellarg($_POST['video_url']) . ' -O /mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension;
					shell_exec($cmd);
					
					shell_exec('rm /mnt/static/entertain/video/' . $this->handle . '.' . $file_extension);
					shell_exec('rm /mnt/static/entertain/video/' . $this->handle . '_high_quality.' . $file_extension);
					
					// Low quality
					video_tools::convert_to_flv('/mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension, '/mnt/static/entertain/video/' . $this->handle . '.flv');
					
					// High quality
					video_tools::convert_to_flv('/mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension, '/mnt/static/entertain/video/' . $this->handle . '_high_quality.flv', 'high');
					
					shell_exec('rm /mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension);
					
					$this->data['file'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.flv';
					$this->data['preview'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.jpg';
					video_tools::generate_preview('/mnt/static/entertain/video/' . $this->handle . '.flv', '/mnt/static/entertain/video/' . $this->handle . '.jpg');
				break;
				case 'upload':
					$file_extension = end(explode(".", $_FILES['video_upload']['name']));
					tools::debug($file_extension);
					move_uploaded_file($_FILES['video_upload']['tmp_name'], '/mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension);
					
					shell_exec('rm /mnt/static/entertain/video/' . $this->handle . '.' . $file_extension);
					shell_exec('rm /mnt/static/entertain/video/' . $this->handle . '_high_quality.' . $file_extension);
					
					// Low quality
					video_tools::convert_to_flv('/mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension, '/mnt/static/entertain/video/' . $this->handle . '.flv');
					
					// High quality
					video_tools::convert_to_flv('/mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension, '/mnt/static/entertain/video/' . $this->handle . '_high_quality.flv', 'high');
					
					shell_exec('rm /mnt/static/entertain/video_tmp/' . $this->handle . '.' . $file_extension);
					
					$this->data['preview'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.jpg';
					$this->data['file'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.flv';
					video_tools::generate_preview('/mnt/static/entertain/video/' . $this->handle . '.flv', '/mnt/static/entertain/video/' . $this->handle . '.jpg');
				break;
			}
			tools::debug('Updating from post!');
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/video.php', array('item' => $this, 'data' => $this->get('data')));
		}
	}
?>