<?php
	class page_cowsay_generator_start extends page
	{
		function url_hook($uri)
		{
			return $uri == '/cowsay' ? 10 : 0;
		}
		function execute($uri)
		{
			$cow = new cowsay();
			$message = 'JAVA är för kossor och får';
			$cow->set(array('mode' => 'p', 'cow' => 'default', 'message' => $message));
			$this->content = '<pre class="entertain_preformatted">' . $cow->get_cow() . '</pre>';
		}
	}
?>