<?php

class PageSideModuleSort extends Page
{
    public static function url_hook($uri)
    {
	return (String::beginswith($uri, '/sidmodul/sortera') ? 20 : 0);
    }
    
    public function execute($uri)
    {
	$order = trim(substr(urldecode($uri), 18), '|');
	$order = explode('|', str_replace('side_module_', '', $order));
	
	$this->user->save_module_order($order);
	
	$this->raw_output = true;
    }
}
?>