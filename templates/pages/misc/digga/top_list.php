<ul class="digga_toplist">
	<?php foreach($artists AS $artist): ?>
		<li>
			<a href="<?php echo $artist->get('url'); ?>"><?php echo $artist->get('name'); ?></a>
		</li>
	<?php endforeach; ?>
</ul>