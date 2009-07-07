<?php
	
	class entertain_preformatted extends entertain
	{
		function render()
		{
			return template('entertain/views/preformatted.php', array('item' => $this));
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
		}
	}

?>