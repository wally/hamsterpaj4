<?php
	class cowsay extends hp4
	{
		private $eye_string; # -e
		private $tongue_string; # -T
		private $message_wrap; # -W default: 40;
		private $mode; # Valid modes are specified in this->modes.
		private $modes = array(
			'borg' => 'b',
			'dead' => 'd',
			'greedy' => 'g',
			'paranoid' => 'p',
			'stoned' => 's',
			'tired' => 't',
			'wired' => 'w',
			'youthful' => 'y'
		);
		private $cow;
		private $cows = array(
			'apt', 
			'beavis.zen', 'bong', 'bud-frogs', 'bunny',
			'calvin', 'cheese', 'cock', 'cower',
			'daemon', 'default', 'dragon-and-cow', 'dragon', 'duck',
			'elephant', 'elephant-in-snake',
			'eyes',
			'flaming-sheep',
			'ghostbusters', 'gnu',
			'head-in', 'hellokitty',
			'kiss', 'kitty', 'koala', 'kosh',
			'luke-koala',
			'mech-and-cow', 'meow', 'milk', 'moofasa', 'moose', 'mutilated',
			'ren',
			'satanic', 'sheep', 'skeleton', 'small', 'sodomized', 'sodomized-sheep', 'stegosaurus', 'stimpy', 'supermilker', 'surgery', 'suse',
			'telebears', 'three-eyes', 'turkey', 'turtle', 'tux',
			'udder',
			'vader', 'vader-koala',
			'www',
		);
		private $message;
		
		public function set_mode($mode)
		{
			if (in_array($mode, $this->modes))
			{
				$this->mode = $mode;
			}
			else
			{
				return false;
			}
		}
		
		public function set_eye_string($string)
		{
			$this->eye_string = escapeshellarg($string);
		}
		
		public function set_toungue_string($string)
		{
			$this->tongue_string = escapeshellarg($string);
		}
		
		public function set_message_wrap($integer)
		{
			if (ctype_digit($integer))
			{
				$this->message_wrap = $integer;
			}
			else
			{
				return false;
			}
		}
		
		public function set_cow($cow)
		{
			if (in_array($cow, $this->cows))
			{
				$this->cow = $cow;
			}
			else
			{
				return false;
			}
		}
		
		public function set_message($message)
		{
			$this->message = escapeshellarg($message);
		}
		
		public function get_cow()
		{
			$cmd = 'cowsay';
			$cmd .= $this->eye_string == NULL ? NULL : ' -e "' . $this->eye_string . '"';
			$cmd .= $this->cow == NULL ? NULL : ' -f ' . $this->cow . '';
			$cmd .= $this->tongue_string == NULL ? NULL : ' -t "' . $this->tongue_string . '"';
			$cmd .= $this->message_wrap == NULL ? NULL : ' -W ' . $this->message_wrap;
			$cmd .= $this->mode == NULL ? NULL : ' -' . $this->mode;
			$cmd .= $this->message == NULL ? ' "Eftersom du inte skrev in någon text så har jag inget mer att säga dig än detta."' : ' ' . $this->message . '';
			
			exec($cmd, $lines);
			system($cmd);
			tools::debug(posix_getpwnam('www-data'));
			tools::debug($lines);
		}
	}
?>