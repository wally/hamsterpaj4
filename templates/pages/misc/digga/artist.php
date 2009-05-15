<a href="/digga">Tillbaks till Digga</a>
<h1><?php echo $artist->get('name'); ?></h1>
<p><?php echo $artist->get('fan_count'); ?> fans just nu</p>
<div class="fans">
	<?php foreach($fans AS $fan) : ?>
		<?php tools::debug($fan); ?>
		<?php echo $fan->profile_mini(); ?>
	<?php endforeach; ?>
</div>

<?php if(!$artist->is_fan($user)) : ?>
	<form action="/digga/ny-digga" method="post">
		<input type="hidden" name="artist" value="<?php echo $artist->get('name'); ?>" />
		<input type="submit" value="Börja digga <?php echo $artist->get('name'); ?>" />
	</form>
<?php endif; ?>

<img src="<?php echo $artist->graph_url(); ?>" />

<?php	if($user->exists()) : ?>
	<?php echo template('pages/misc/digga/classification_form.php', array('classifications' => $user_classifications, 'artist' => $artist)); ?>
<?php endif; ?>

