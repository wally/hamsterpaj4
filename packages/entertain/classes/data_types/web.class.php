<?php
	class EntertainWeb extends Entertain
	{
		function render()
		{
			return template('entertain', 'views/web.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/web.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{
			$this->data['url'] = $_POST['url'];
			$this->data['link'] = $_POST['link'];
		}
	}
?>