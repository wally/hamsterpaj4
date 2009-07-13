<?php
	class entertain_preformatted extends entertain
	{
		function render()
		{
			return template('entertain', 'views/preformatted.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/preformatted.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{
			$this->data['content'] = $_POST['content'];
		}
	}
?>