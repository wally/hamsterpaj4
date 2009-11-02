<?php

function beat_events(Page $page)
{
    $photo_comments = $page->user->get_unread_photo_comments();
    return template('heartbeat', 'beat_events.php', array('photo_comments' => $photo_comments, 'user' => $page->user));
}
