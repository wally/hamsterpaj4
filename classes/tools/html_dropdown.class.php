<?php
	class HTMLDropdown extends HP4
	{
		private $selected;
		
		function set_name($name)
		{
			$this->name = $name;
		}
		
		function add_option($option)
		{
			$this->options[] = $option;
		}
		
		function set_selected($value)
		{
			$this->selected = $value;
		}
		
		function render()
		{
			$o = '<select';
			$o .= (isset($this->name)) ? ' name="' . $this->name . '"' : null;
			$o .= '>' . "\n";
			foreach($this->options AS $opt)
			{
				$o .= '<option';
				$o .= (isset($opt['value'])) ? ' value="' . $opt['value'] . '"' : null;
				$o .= (isset($opt['value']) && $opt['value'] == $this->selected) ? ' selected="true"' : null;
				$o .= '>' . $opt['label'] . '</option>';
			}
			$o .= '</select>';
			
			return $o;
		}
	}
?>