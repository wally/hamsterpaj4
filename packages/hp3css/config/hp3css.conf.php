<?php

class HP3Config
{
    public static $rewrites = array(
	// Photoblog uses special URL:s
	'#photoblog_[A-Za-z0-9]*_[A-Za-z0-9]*_\.css#'
    );
    
    public static $replaces = array(
	'photoblog.css.php'
    );
}