<?php
	class Comment
	{
		function build_comment($data = array())
		{
			$this->user = User::fetch(array('id' => $this->user_id));
		}
		
		function render($user)
		{
			$this->remove_privilegied = $user->privilegied('comments_admin', $this->type);
			
			return template('comment', 'comment.php', $this);
		}
		
		function add()
		{
			global $_PDO;
			
			$query = 'INSERT INTO comments
				    SET 
					item_id = "' . $this->item_id . '", 
					type = "' . $this->type . '", 
					timestamp = UNIX_TIMESTAMP(), 
					text = "' . $this->text . '", 
					user_id = ' . $this->user->get('id') . '
			';
			
			Tools::debug($query);
			$_PDO->exec($query);
		}
		
		function remove()
		{
			global $_PDO;
			
			$query = 'UPDATE comments SET removed = 1 WHERE id = "' . $this->id . '" LIMIT 1';
			$_PDO->exec($query);
		}
		
		function content_check()
		{
			// We need a package with administration tool for anti-spam filtering in the future
			
			$this->text = strtolower(' ' . $this->text . ' ');
			
			$banned_strings = array(
				'?r=',
				'msn-tools.de/?nr=', 
				'fragbite.com/?userID',
				'?refer=',
				'?ragga=',
				'?ref=',
				'gangstawar',
				'kingsofchaos',
				'referralid=',
				'sexy-lena.com',
				'emocore.se',
				'monstersgame.se',
				'alltgratis.se',
				'?pundare=',
				'rochas.se',
				'th0nd-elajt.no-ip.org',
				'albanau',
				'xth.nu',
				'gamblingcommunity.se',
				'oddsite',
				'adduser.php',
				'liferace',
				'studiotraffic.com',
				'gurk.php/',
				'?Tipsare',
				'clickltad.php?uid',
				'?tipsa',
				'tribalwars',
				'?referral=',
				'?ac=vid&',
				'index.php?ac=main',
				'charles.tk',
				'travian.se',
				'monstersgame',
				'nogg.se',
				'egenbild.se/?i',
				'c.php?uid=',
				'pimpland.se',
				'myminicity.com', 
				'neopets.com',
				'ref.php?user=',
				'?r=',
				'page.php?id=',
				'vinnpris.se', 
				'/skiten/lur.php?id=',
				'sexyemilie',
				'sexye.milie',
				'sexy.emilie',
				'sexy*emilie',
				'milie.com/?id=',
				'sexy-emilie',
				'emilie.com',
				'emilie,com',
				'www.rivality.notlong.com',
				'rivality.com',
				'rivality.notlong',
				'EXgirl007.myhotpicss.com',
				'EXgirl',
				'myhotpicss',
				'ihate',
				'deflower',
				'?uid=',
				'inviter-ven.php?id=',
				'my-first-time-naked.net/?id=6161575',
				'xyem',
				'mybrute.com'
			);
				
			foreach($banned_strings AS $banned)
			{
				if(strpos($this->text, $banned) == true)
				{
					return false;
				}
			}
			
			return true;
		}
	}
?>