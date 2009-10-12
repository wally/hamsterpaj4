<?php
	class Cowsay extends HP4
	{
		protected $eye_string; # -e
		protected $tongue_string; # -T
		protected $message_wrap; # -W default: 40;
		protected $mode; # Valid modes are specified in this->modes.
		protected $modes = array();
		protected $cow;
		protected $cows = array();
		protected $message;
		
		public function __construct()
		{
			global $_COWSAY_COWS, $_COWSAY_MODES;
			$this->cows = $_COWSAY_COWS;
			$this->modes = $_COWSAY_MODES;
		}
		
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
			if (strlen($string) >= 1)
			{
				$this->eye_string = escapeshellarg($string) . str_repeat(' ', 2 - strlen($string));
			}
		}
		
		public function set_toungue_string($string)
		{
			if (strlen($string) >= 1)
			{
				$this->tongue_string = escapeshellarg($string) . str_repeat(' ', 2 - strlen($string));
			}
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
			$this->message = utf8_decode(escapeshellarg($message));
		}
		
		public function get_cow()
		{
			$cmd = '/usr/games/cowsay';
			$cmd .= $this->eye_string == NULL ? NULL : ' -e ' . $this->eye_string;
			$cmd .= $this->cow == NULL ? NULL : ' -f ' . $this->cow;
			$cmd .= $this->tongue_string == NULL ? NULL : ' -T ' . $this->tongue_string;
			$cmd .= $this->message_wrap == NULL ? NULL : ' -W ' . $this->message_wrap;
			$cmd .= $this->mode == NULL ? NULL : ' -' . $this->mode;
			$cmd .= $this->message == NULL ? ' "Eftersom du inte skrev in någon text så har jag inget mer att säga dig än detta."' : ' ' . $this->message . '';
			
			return utf8_encode(htmlentities(shell_exec($cmd)));
		}
	}
?>