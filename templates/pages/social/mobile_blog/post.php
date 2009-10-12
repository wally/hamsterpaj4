<li>
	<img class="avatar" src="<?php echo $user->avatar_thumb_url(); ?>" />
	<div class="content">
		<h2 class="user"><a href="/<?php echo $user->get('username'); ?>/mobilblogg"><?php echo $user->get('username'); ?></a></h2>
		<p>
			<?php echo $text; ?>
		</p>
		<span class="timestamp"><?php echo Tools::date_readable($timestamp); ?></span><?php if($remove_privilegied): ?><a href="/mobilbogg/radera/<?php echo $id; ?>">Radera</a><?php endif; ?>
		<div class="comments">
			<?php echo $comment_list->render(); ?>
		</div>
	</div>
</li>