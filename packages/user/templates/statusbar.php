<div id="status">
	<img src="<?php echo $user->avatar_thumb_url(); ?>" class="user_avatar" />
	<div id="ui_statusbar_username">
		<a href="<?php echo $user->profile_url(); ?>"><?php echo $user->username; ?></a>
		<span> | </span><a href="/logout">Logga ut</a><br />
	</div>
	<span>Online <?php echo tools::duration_readable(time() - $user->last_logon); ?></span>
	<div id="ui_statusbar_forumstatus">
		<span title="<?php echo $user->signature; ?>"><?php echo $user->signature; ?></span>
	</div>
</div>