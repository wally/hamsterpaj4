<?php

class Counter
{
	private $current = 0;
	private $on_true = 0;
	private $on_false = 0;
	private $modulo;
	
	public function __construct($on_true, $on_false, $mod = 2)
	{
		$this->on_true = $on_true;
		$this->on_false = $on_false;
		$this->modulo = $mod;
	}

	public function row()
	{
		return $this->current++ % $this->modulo ? $this->on_true : $this->on_false;
	}

	public function __toString()
	{
		return $this->row	();
	}
}
?>