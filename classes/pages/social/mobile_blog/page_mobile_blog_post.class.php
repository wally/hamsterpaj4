<?php
	class PageMobileBlogPost extends Page
	{
		function url_hook($uri)
		{
			return ($uri == '/mobilblogg/skicka') ? 10 : 0;
		}

		function execute()
		{
			if(!$this->user->exists())
			{
				throw new Exception('Du måste vara inloggad för att använda den här funktionen');
			}
			
			$entry = new MobileBlog;
			
			$entry->user = $this->user;
			$entry->text = $_POST['text'];
			$entry->type = 'text';
			$entry->add();
			
			$this->content = 'Om Daniella nu hade haft ett routingsystem så hade vi kastat tillbaka dig till sidan du kom ifrån, men Johan har inte kodat det ännu. <a href="/mobilblogg/">Gå tillbaka</a>';
		}
	}
?>