<?php
	
	class entertain_image extends entertain
	{
		function render()
		{
			return template('entertain' , 'views/image.php', array('item' => $this));
		}
		
		
		function set_data($data)
		{
			$this->data['text'] = $data['text'];
			$this->data['allow_html'] = $data['allow_html'];
		}
		
		function update_data_from_post()
		{
			switch($_POST['image_action'])
			{
				case 'wget':
					$cmd = 'wget ' . escapeshellarg($_POST['image_url']) . ' -O /mnt/static/entertain/images/' . escapeshellarg($this->handle) . '.jpg';
					shell_exec($cmd);
					$cmd = 'convert /mnt/static/entertain/images/' . escapeshellarg($this->handle) . '.jpg -resize "637x1024" ' . PATH_STATIC . 'entertain/images/' . escapeshellarg($this->handle) . '.jpg';
					system($cmd);
				break;
				case 'upload':
					if(is_uploaded_file($_FILES['image_upload']['tmp_name']))
					{
						$cmd = 'convert ' . $_FILES['image_upload']['tmp_name'] . ' -resize "638x1024" ' . PATH_STATIC . 'entertain/images/' . escapeshellarg($this->handle) . '.jpg';
						system($cmd);
					}
				break;
			}
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/image.php', array('item' => $this, 'data' => $this->get('data')));
		}
	}

?>