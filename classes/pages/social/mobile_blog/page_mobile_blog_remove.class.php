<?php
	class PageMobileBlogRemove extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/mobilblogg/radera') ? 10 : 0;
		}

		function execute()
		{
			if(!$this->user->exists() || !$this->user->privilegied('mobile_blog_remove'))
			{
				throw new Exception('Du måste vara inloggad för att använda den här funktionen');
			}
			
			$entry = new MobileBlog;
			
			$entry->id = $_GET['id'];
			$entry->remove();
			$this->content = 'Om Daniella nu hade haft ett routingsystem så hade vi kastat tillbaka dig till sidan du kom ifrån, men Johan har inte kodat det ännu. <a href="/mobilblogg/">Gå tillbaka</a>';
		}
	}
