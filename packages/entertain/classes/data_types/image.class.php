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
		
		function update_from_post()
		{
			$this->set(array('title' => $_POST['title']));
			$this->set(array('category' => $_POST['category']));
			$this->set(array('has_image' => $_POST['has_image']));
			
			if(is_uploaded_file($_FILES['image']['tmp_name']))
			{
				$cmd = 'convert ' . $_FILES['image']['tmp_name'] . ' -resize "637x1024" ' . PATH_STATIC . 'entertain/' . $this->handle . '.jpg';
				tools::debug($cmd);
				system($cmd);
			}
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/image.php', array('item' => $this, 'data' => $this->get('data')));
		}
	}

?>