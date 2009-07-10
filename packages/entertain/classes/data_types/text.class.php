<?php
	class entertain_text extends entertain
	{
		function render()
		{
			return template('entertain', 'views/text.php', array('item' => $this));
		}
						
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/text.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{
			$this->data['text'] = $_POST['text'];
			$this->data['allow_html'] = $_POST['allow_html'];
		}
	}
?>