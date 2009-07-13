<?php
	class entertain_iframe extends entertain
	{
		function render()
		{
			return template('entertain', 'views/iframe.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/iframe.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{
			$this->data['url'] = $_POST['url'];
		}
	}
?>