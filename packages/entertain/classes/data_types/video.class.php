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
					$cmd = 'wget ' . escapeshellarg($_POST['video_url']) . ' -O /mnt/static/entertain/video/' . $this->handle . '.flv';
					shell_exec($cmd);
					$this->data['file'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.flv';
					$this->data['preview'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.jpg';
					mpwplayer::generate_preview('/mnt/static/entertain/video/' . $this->handle . '.flv', '/mnt/static/entertain/video/' . $this->handle . '.jpg');
				break;
				case 'upload':
					move_uploaded_file($_FILES['video_upload']['tmp_name'], '/mnt/static/entertain/video/' . $this->handle . '.flv');
					$this->data['file'] = 'http://static.hamsterpaj.net/entertain/video/' . $this->handle . '.flv';
					mpwplayer::generate_preview('/mnt/static/entertain/video/' . $this->handle . '.flv', '/mnt/static/entertain/video/' . $this->handle . '.jpg');
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