<li id="<?php echo $type . '-' . $item_id . '-' . $id; ?>">
	<img class="user_avatar" src="<?php echo $user->avatar_thumb_url() ?>" alt="<?php echo $user->get('username'); ?>" />
	<div class="content">
		<h2 class="user"><a href="/traffa/profile.php?user_id=<?php echo $user->get('id'); ?>"><?php echo $user->username ?></a></h2>
		<p>
			<?php echo $text ?>
		</p>
		<span class="timestamp"><?php echo Tools::date_readable($timestamp); ?></span><?php if(Tools::is_true($remove_privilegied)): ?> | <a href="" class="remove">Radera</a><?php endif; ?>
	</div>
</li>