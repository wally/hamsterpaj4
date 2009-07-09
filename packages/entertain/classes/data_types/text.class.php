<?php
	class entertain_text extends entertain
	{
		function render()
		{
			return template('entertain', 'views/text.php', array('item' => $this));
		}
		
		function update_data_from_post()
		{
			$this->data['text'] = $_POST['text'];
			$this->data['allow_html'] = $_POST['allow_html'];
		}
	}
?>