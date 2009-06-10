<?php
	
	class entertain_preformatted extends entertain
	{
		function render()
		{
			return template('entertain/views/preformatted.php', array('item' => $this));
		}
		
	}

?>