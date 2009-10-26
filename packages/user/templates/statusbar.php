<div id="status">
	<img src="<?php echo $user->avatar_thumb_url(); ?>" class="user_avatar" />
	<div id="ui_statusbar_username">
		<a href="<?php echo $user->get('profile_url'); ?>"><?php echo $user->username; ?></a>
		<span> | </span><a href="/login/logout.php">Logga ut</a><br />
	</div>
	<span>Online <?php echo Tools::duration_readable(time() - $user->last_logon); ?></span>
	<div id="ui_statusbar_forumstatus">
		<span title="<?php echo $user->signature; ?>"><?php echo ((strlen(trim($user->signature)) > 0) ? ((mb_strlen($user->signature, 'UTF8') > 22) ? mb_substr($user->signature, 0, 19, 'UTF8') . '...' : $user->signature) : 'Ingen status'); ?></span>
	</div>
</div>