<?php
	class entertain_flash extends entertain
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
					$cmd = 'wget ' . escapeshellarg($_POST['flashfile_url']) . ' -O /mnt/static/entertain/' . $this->handle . '.swf';
					shell_exec($cmd);
					$this->data['flashfile'] = 'http://static.hamsterpaj.net/entertain/' . $this->handle . '.swf';
					break;
				case 'upload':
					move_uploaded_file($_FILES['flashfile_upload']['tmp_name'], '/mnt/static/entertain/' . $this->handle . '.swf');
					$this->data['flashfile'] = 'http://static.hamsterpaj.net/entertain/' . $this->handle . '.swf';
					break;
			}
			tools::debug('Updating from post!');
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/flash.php');
		}
	}
?>