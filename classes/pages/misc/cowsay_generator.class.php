<?php
	class PageCowsayGeneratorStart extends page
	{
		function url_hook($uri)
		{
			return $uri == '/cowsay' ? 10 : 0;
		}
		function execute($uri)
		{
			if (isset($_GET['message']))
			{
				$cow = new Cowsay();
				$cow->set(array(
					'mode' => $_GET['mode'], 
					'eye_string' => $_GET['eye_string'], 
					'tongue_string' => $_GET['tongue_string'], 
					'cow' => $_GET['cow'], 
					'message' => $_GET['message'],
					'message_wrap' => $_GET['message_wrap']
				));
				$this->content = template('pages/misc/cowsay_generator.php', array('cow' => $cow));
			}
			else
			{
				$cow = new Cowsay();
				$cow->set(array('message' => $welcome_message));
				$this->content = template('pages/misc/cowsay_generator.php', array('cow' => $cow));
			}
		}
	}
?>