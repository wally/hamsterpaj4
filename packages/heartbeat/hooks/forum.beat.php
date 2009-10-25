<?php

function beat_forum(Page $page)
{
    $unread = $page->user->get_unread_forum_posts();
    
    $subscriptions = $page->user->get_forum_subscriptions();
    foreach ( $subscriptions as $key => $thread )
    {
	if ( $thread['unread_posts'] == 0 )
	{
	    unset($subscriptions[$key]);
	}
    }
    
    $forum_subs = $page->user->get_forum_category_subscriptions();
    $notices = $page->user->get_forum_notices();
    
    return template('heartbeat', 'beat_forum.php',
	array(
	    'unread' => $unread,
	    'subscriptions' => $subscriptions,
	    'forum_subscriptions' => $forum_subs,
	    'notices' => $notices
	)
    );
}
