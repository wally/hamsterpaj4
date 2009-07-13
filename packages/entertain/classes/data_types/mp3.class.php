<?php
	class entertain_mp3 extends entertain
	{
		function render()
		{
			return template('entertain', 'views/mp3.php', array('item' => $this));
		}
						
		function render_edit_form()
		{
			return template('entertain', 'admin/edit/mp3.php', array('item' => $this, 'data' => $this->get('data')));
		}
		
		function update_data_from_post()
		{

		}
	}
?>