<?php
	class EntertainFile extends Entertain
	{
		function render()
		{
			$data = $this->get('data');
			$data['file_path'] = URL_STATIC . 'entertain/files/' . $data['filename'];
			$icon_url = URL_STATIC . 'images/icons/256x256/' . strtoupper(end(explode(".", $data['filename']))) . '.png';
			$icon_path = PATH_STATIC . 'images/icons/256x256/' . strtoupper(end(explode(".", $data['filename']))) . '.png';
			
			if(!file_exists($icon_path))
			{
				$icon_url = 'http://static.hamsterpaj.net/images/icons/256x256/Default.png';
			}
			$data['file_type_icon'] = $icon_url;
			
			return template('entertain', 'views/file.php', array('item' => $this, 'data' => $data));
		}
				
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/file.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{
			switch($_POST['file_action'])
			{
				case 'wget':
					$file_extension = escapeshellarg(end(explode(".", $_POST['url'])));
				
					$this->data['filename'] = $this->get('handle') . '.' . $file_extension;
					
					// delete file if it already exists
					if(file_exists(PATH_STATIC . 'entertain/files/' . escapeshellarg($this->get('handle')) . '.' . $file_extension))
					{
						$cmd = 'rm ' . PATH_STATIC . 'entertain/files/' . escapeshellarg($this->get('handle')) . '.' . $file_extension;
						system($cmd);
					}
					
					// Upload file
					$cmd = 'wget ' . escapeshellarg($_POST['url']) . ' -O ' . PATH_STATIC . 'entertain/files/' . escapeshellarg($this->get('handle')) . '.' . $file_extension;
					system($cmd);
					
					$this->data['size'] = filesize(PATH_STATIC . 'entertain/files/' . $this->get('handle') . '.' . $file_extension);
					$this->data['type'] = filetype(PATH_STATIC . 'entertain/files/' . $this->get('handle') . '.' . $file_extension);
				break;
				
				case 'upload':
					$file_extension = escapeshellarg(end(explode(".", $_FILES['file']['name'])));
			
					$this->data['filename'] = $this->get('handle') . '.' . $file_extension;
					$this->data['size'] = $_FILES['file']['size'];
					$this->data['type'] = $_FILES['file']['type'];
					
					// delete file if it already exists
					if(file_exists(PATH_STATIC . 'entertain/files/' . $this->get('handle') . '.' . $file_extension))
					{
						$cmd = 'rm ' . PATH_STATIC . 'entertain/files/' . escapeshellarg($this->get('handle')) . '.' . $file_extension;
						system($cmd);
					}
					
					// upload file
					if(is_uploaded_file($_FILES['file']['tmp_name']))
					{
						if(!move_uploaded_file($_FILES['file']['tmp_name'], PATH_STATIC . 'entertain/files/' . $this->get('handle') . '.' . $file_extension))
						{
							Tools::debug('Filen flyttades inte');
						}
					}
					else
					{
						Tools::debug('Filen laddades inte upp');
					}
					
				break;
			}
			$this->data['description'] = $_POST['description'];
		}
	}
?>