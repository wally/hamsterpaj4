<div class="artist">
	<h1><a href="/digga">Digga</a> &raquo; <?php echo $artist->get('name'); ?></h1>
	<p><?php echo $artist->get('fan_count'); ?> fans just nu</p>
	<div class="fans">
		<?php foreach($fans AS $fan) : ?>
			<?php echo $fan->profile_mini(); ?>
		<?php endforeach; ?>
	</div>
	
	<?php if($user->exists() && !$artist->is_fan($user)) : ?>
		<form action="/digga/ny-digga" method="post">
			<input type="hidden" name="artist" value="<?php echo $artist->get('name'); ?>" />
			<input type="submit" value="Börja digga <?php echo $artist->get('name'); ?>" />
		</form>
	<?php endif; ?>
	
	<h2>Musikstil</h2>
	<img src="<?php echo $artist->graph_url(); ?>" class="artist_radar" />
	<ul class="digga_classifications">
		<?php foreach($artist->get_classifications() AS $class) : ?>
			<li>
				<h4><a href="/digga/musikstilar/<?php echo $class['handle']; ?>"><?php echo $class['name']; ?></a></h4>
			</li>
		<?php endforeach; ?>
	</ul>
		
	<?php	if($user->exists()) : ?>
		<?php if($artist->is_fan($user)) : ?>
			<?php echo template('pages/misc/digga/classification_form.php', array('classifications' => $user_classifications, 'artist' => $artist)); ?>
		<?php else : ?>
		
		<?php endif; ?>
	<?php endif; ?>
	
	<?php $group = $artist->get('group'); ?>
	<h2><a href="/traffa/groups.php?action=goto&groupid=<?php echo $group->get('id'); ?>">
		Gruppen <?php echo $group->get('name'); ?>
	</a></h2>
	
	<?php echo template('group/entry_list.php', array('entries' => $artist->get('group')->entries())); ?>	

	
	<a href="spotify:search:<?php echo $artist->get('name'); ?>">
		<div class="digga_spotify_search">
				<img src="http://static.hamsterpaj.net/images/icons/32x32/spotify.png" />
				Sök efter <?php echo $artist->get('name'); ?> på Spotify
			</a>
		</div>
	</a>
</div>