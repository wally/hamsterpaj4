<li>
	<img class="avatar" src="<?php echo $user->avatar_thumb_url(); ?>" />
	<div class="content">
		<h2 class="user"><?php echo $user->get('username'); ?></h2>
		<p>
			<?php echo $text; ?>
		</p>
		<span class="timestamp"><?php echo tools::date_readable($timestamp); ?></span>
		<div class="comments">
			<?php echo $comment_list->render(); ?>
		</div>
	</div>
</li>