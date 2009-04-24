<div id="status">
	<img src="<?php echo $page->avatar_thumb_url(); ?>" class="user_avatar" />
	<div id="ui_statusbar_username">
		<a href="<?php echo $page->profile_url(); ?>"><?php echo $page->username; ?></a>
		<span> | </span><a href="/logout">Logga ut</a><br />
	</div>
	<span>Online <?php echo tools::time_readable(time() - $page->last_logon); ?></span>
	<div id="ui_statusbar_forumstatus">
		<span title="<?php echo $page->signature; ?>"><?php echo $page->signature; ?></span>
	</div>
</div>