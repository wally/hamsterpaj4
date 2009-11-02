<?php

class ECache
{
    public static function output($filename)
    {
	$stat = @stat($filename);
	$etag = sprintf('%x-%x-%x', $stat['ino'], $stat['size'], $stat['mtime'] * 1000000);
    
	header('Expires: ');
	header('Cache-Control: ');
	header('Pragma: ');
    
	if ( isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] == $etag)
	{
	    header('Etag: "' . $etag . '"');
	    header('HTTP/1.0 304 Not Modified');
	    return 304;
	}
	elseif ( isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $stat['mtime'])
	{
	    header('Last-Modified: ' . date('r', $stat['mtime']));
	    header('HTTP/1.0 304 Not Modified');
	    return 304;
	}
    
	header('Last-Modified: ' . date('r', $stat['mtime']));
	header('Etag: "' . $etag . '"');
	header('Accept-Ranges: bytes');
	header('Content-Length:' . $stat['size']);
    
	readfile($filename);
    }
}
?>