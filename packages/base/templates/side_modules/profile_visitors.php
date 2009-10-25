<?php $counter = 1; ?><a class="minimize" href="#">+</a><h5>Besökare</h5><a class="move" href="#">=</a>
<ul>
	<?php foreach($module->visitors AS $visitor) : ?>
		<li class="visitor_<?php echo $counter++; ?>">
			<a href="<?php echo $visitor->profile_url(); ?>" title="<?php echo $visitor->get('username'); ?> besökte dig <?php echo Tools::date_readable($visitor->get('last_visit')); ?>">
			<img src="<?php echo $visitor->avatar_thumb_url(); ?>" />
			</a>
		</li>
	<?php endforeach; ?>
</ul>
<a href="/traffa/my_visitors.php" class="show_more_link">Visa fler</a>