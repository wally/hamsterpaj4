<?php
	class html_dropdown extends hp4
	{
		function set_name($name)
		{
			tools::debug('This is set_name!');
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
			tools::debug($this);
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