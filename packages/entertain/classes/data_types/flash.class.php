<?php
	class EntertainFlash extends Entertain
	{
		function render()
		{
			return template('entertain', 'views/flash.php', array('item' => $this));
		}
		
		function update_data_from_post()
		{
			switch($_POST['flashfile_action'])
			{
				case 'wget':
					unlink('/mnt/static/entertain/flash/' . $this->handle . '.swf');
					$cmd = 'wget ' . escapeshellarg($_POST['flashfile_url']) . ' -O /mnt/static/entertain/flash/' . $this->handle . '.swf';
					shell_exec($cmd);
					$this->data['flashfile'] = 'http://static.hamsterpaj.net/entertain/flash/' . $this->handle . '.swf';
					break;
				case 'upload':
					unlink('/mnt/static/entertain/flash/' . $this->handle . '.swf');
					move_uploaded_file($_FILES['flashfile_upload']['tmp_name'], '/mnt/static/entertain/flash/' . $this->handle . '.swf');
					$this->data['flashfile'] = 'http://static.hamsterpaj.net/entertain/flash/' . $this->handle . '.swf';
				break;
			}
			Tools::debug('Updating from post!');
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/flash.php', array('item' => $this, 'data' => $this->get('data')));
		}
	}
?>