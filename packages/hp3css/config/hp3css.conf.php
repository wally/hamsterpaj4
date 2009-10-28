<?php

class HP3Config
{
    /*
	Property:
	    HP3Config::$rewrites
	
	For rewriting the incoming paths.
    */
    public static $rewrites = array(
	// Photoblog uses special URL:s
	'#photoblog_[A-Za-z0-9]*_[A-Za-z0-9]*_\.css#'
    );
    
    public static $replaces = array(
	'photoblog.css.php'
    );
    
    /*
	Property:
	    HP3Config::$standard
	
	Files that are allways present
    */
    public static $standard = array(
	'shared.css',
	'new_guestbook.css',
	'poll.css'
    );
}