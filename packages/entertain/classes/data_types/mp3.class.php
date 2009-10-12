<?php
	class EntertainMP3 extends Entertain
	{
		function render()
		{
			return template('entertain', 'views/mp3.php', array('item' => $this, 'data' => $this->get('data')));
		}
						
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/mp3.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{
			switch($_POST['mp3_action'])
			{
				case 'wget':
					$cmd = 'wget ' . escapeshellarg($_POST['mp3_url']) . ' -O /mnt/static/entertain/mp3/' . $this->handle . '.mp3';
					shell_exec($cmd);
					$this->data['size'] = filesize(PATH_STATIC . 'entertain/mp3/' . $this->handle . '.mp3');
				break;
				case 'upload':
					move_uploaded_file($_FILES['mp3_upload']['tmp_name'], '/mnt/static/entertain/mp3/' . $this->handle . '.mp3');
					$this->data['size'] = filesize(PATH_STATIC . 'entertain/mp3/' . $this->handle . '.mp3');
				break;
			}
		}
	}
?>