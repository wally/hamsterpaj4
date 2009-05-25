<div class="artist_battle">
	<?php $width = 100 / count($artists); ?>

	<?php
		// Find the highest fan count
		foreach($artists AS $artist) :
			$max_fans = ($max_fans > $artist->get('fan_count')) ? $max_fans : $artist->get('fan_count');
		endforeach;
		shuffle($artists);
	?>

	<?php foreach($artists AS $artist) : ?>
		<?php $height = ($artist->get('fan_count') / $max_fans) * 100; ?>
		<div class="container" style="width: <?php echo $width; ?>%;">
			<a href="<?php echo $artist->get('url'); ?>">
				<?php echo template('pages/misc/digga/artist_mini.php', array('artist' => $artist)); ?>
				<div class="bar_wrapper">
					<div class="bar" style="height: <?php echo $height; ?>%;"></div>
				</div>
				<span><?php echo tools::cute_number($artist->get('fan_count')); ?> fans</span>
			</a>
		</div>
	<?php endforeach; ?>
</div>