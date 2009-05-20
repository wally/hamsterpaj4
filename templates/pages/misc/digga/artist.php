<a href="/digga">Tillbaks till Digga</a>
<h1><?php echo $artist->get('name'); ?></h1>
<p><?php echo $artist->get('fan_count'); ?> fans just nu</p>
<div class="fans">
	<?php foreach($fans AS $fan) : ?>
		<?php echo $fan->profile_mini(); ?>
	<?php endforeach; ?>
</div>

<?php if(!$artist->is_fan($user)) : ?>
	<form action="/digga/ny-digga" method="post">
		<input type="hidden" name="artist" value="<?php echo $artist->get('name'); ?>" />
		<input type="submit" value="Börja digga <?php echo $artist->get('name'); ?>" />
	</form>
<?php endif; ?>

<img src="<?php echo $artist->graph_url(); ?>" class="artist_radar" />

<?php	if($user->exists()) : ?>
	<?php if($artist->is_fan($user)) : ?>
		<?php echo template('pages/misc/digga/classification_form.php', array('classifications' => $user_classifications, 'artist' => $artist)); ?>
	<?php else : ?>
	
	<?php endif; ?>
<?php endif; ?>

<?php	$group = $artist->get('group'); ?>
<a href="/traffa/groups.php?action=goto&groupid=<?php echo $group['id']; ?>">Kolla in gruppen!</a>
