<?php
	class PageMobileBlogSettings extends Page
	{
		public static function url_hook($uri)
		{
			return ($uri == '/mobilblogg/installningar') ? 10 : 0;
		}
		
		function execute()
		{
			$this->content .= template('pages/social/mobile_blog/settings_header.php');
			$this->content .= template('pages/social/mobile_blog/menu.php', array('user' => $this->user));
			
			if(strlen($this->user->get('cell_phone')) < 3)
			{
				$this->content .= template('pages/social/mobile_blog/register_number.php', array('user' => $this->user, 'control_number' => MobileBlog::get_control_number($this->user->username)));
			}
			elseif(strlen($this->user->get('cell_phone')) > 3)
			{
				$this->content .= template('pages/social/mobile_blog/update_number.php', array('user' => $this->user, 'control_number' => MobileBlog::get_control_number($this->user->username)));
			}
		}
	}
?>