<?php

class PageForumStatus extends Page
{
    public $raw_output = true;
    
    public static function url_hook($uri)
    {
	return String::beginswith($uri, '/forumstatus') ? 20 : 0;
    }
    
    public function execute($uri)
    {
	$status = substr($uri, 13);
	$this->user->save_signature(urldecode($status));
    }
}
?>