<?php
	class entertain_html extends entertain
	{
		function render()
		{
			return template('entertain', 'views/html.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/html.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{
			$this->data['html'] = $_POST['html'];
			$this->data['css'] = $_POST['css'];
		}
	}
?>