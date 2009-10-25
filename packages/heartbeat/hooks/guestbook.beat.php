<?php

function beat_guestbook(Page $page)
{
    return $page->user->get_unread_gb_entries();
}
