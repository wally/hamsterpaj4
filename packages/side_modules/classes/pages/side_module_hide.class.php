<?php

class PageSideModuleHide extends Page
{
    public $raw_output = true;
    
    public static function url_hook($uri)
    {
	return String::beginswith($uri, '/sidmodul/minimera/') ? 20 : 0;
    }
    
    public function execute($uri)
    {
	$module = substr($uri, 19);
	$pieces = explode('/', $module);
	
	$module = $pieces[0];
	$state = in_array($pieces[1], array('open', 'close')) ? $pieces[1] : 'open';
	
	$this->user->save_module_state($module, $state);
    }
}
?>