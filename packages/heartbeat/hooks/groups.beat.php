<?php

function beat_groups(Page $page)
{
    $groups = array(
	246 => array(
	    'name' => 'Webdesign',
	    'unread' => 10
	)
    );
    
    return htmlentities(template('heartbeat', 'beat_group.php', array('groups' => $groups)));
}
