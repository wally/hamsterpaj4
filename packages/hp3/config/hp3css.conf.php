<?php
 
class HP3Config
{
    /*
        Property:
            HP3Config::$rewrites
        For rewriting the incoming paths.
    */
    public static $rewrites_css = array(
	// Photoblog uses special URL:s
	'#photoblog_[A-Za-z0-9]*_[A-Za-z0-9]*_\.css#'
    );
    
    public static $replaces_css = array(
	'photoblog.css.php'
    );
    
    /*
	Property:
	    HP3Config::$standard
	Files that are allways present
    */
    public static $standard_css = array(
	'shared.css',
	'new_guestbook.css',
	'poll.css'
    );
}
?>