<?php

class HookNotFoundException extends Exception {}

/*
    Class:
	PageHeartbeat
    
    Hooks are loaded from files named hookname.beat.php, and are functions named hook_hookname.
    They are called with a <Page> object, which will be the instance of <PageHeartbeat>.
    
    Prototype of a beat:
	function beat_groups(Page $page);
    
    Some legacy hooks are contained in this packages' hooks/-directory. Other hooks can be added
    in your packages.
*/

class PageHeartbeat extends Page
{
    public $template = 'system/json.php';
    
    private static $hooks = null;
    
    public static public static function url_hook($uri)
    {
	return (String::beginswith($uri, '/heartbeat') ? 50 : 0);
    }
    
    public function execute($uri)
    {
	$hooks = self::get_hooks();
	
	foreach ( $hooks as $hook )
	{
	    $function = 'beat_' . $hook;
	    $this->content[$hook] = htmlentities(call_user_func($function, $this), ENT_QUOTES, 'UTF-8');
	}
    }
    
    public static function run_hook($hook_name, Page $page)
    {
	$hooks = self::get_hooks();
	if ( ! in_array($hook_name, $hooks) )
	{
	    throw new HookNotFoundException($hook_name);  
	}
	
	return call_user_func('beat_' . $hook_name, $page);
    }
    
    private static function get_hooks()
    {
	if ( ! is_null(self::$hooks) )
	{
	    return self::$hooks;
	}
	
	$hooks = Tools::find_files(PATH_PACKAGES, array('endswith' => '.beat.php'));
	$ret = array();
	
	foreach ( $hooks as $hook )
	{
	    $ret[] = preg_replace('#([A-Za-z0-9-_]+)\.beat\.php#', '$1', end(explode('/', $hook)));
	    include(PATH_PACKAGES . $hook);
	}
	
	self::$hooks = $ret;
	
	return $ret;
    }
}
