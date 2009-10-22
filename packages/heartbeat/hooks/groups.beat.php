<?php

function beat_groups(Page $page)
{
    $unread = $page->user->get_unread_group_entries();
    $groups = $page->user->get('cache');
    $groups = $groups['group_notices'];
        
    return template('heartbeat', 'beat_group.php', array('groups' => $groups, 'unread' => $unread));
}
