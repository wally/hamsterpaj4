<div class="user_profile_mini">
	<a href="<?php echo $user->get('profile_url'); ?>">
		<img src="<?php echo $user->avatar_thumb_url(); ?>" />
		<h3><?php echo $user->get('username'); ?></h3>
		<p>
			<?php echo $user->get('gender'); ?>
			<?php echo ($user->get('age')) ? $user->get('age') . ' år' : ''; ?>
			<?php echo $user->get('geo_location'); ?>
		</p>
	</a>
</div>