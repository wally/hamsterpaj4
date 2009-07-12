<ul class="entertain_preview">
	<?php foreach($items AS $item) : ?>
	<a href="<?php echo $item->get('url'); ?>">
		<li>
			<img src="<?php echo $item->preview_image('medium'); ?>" />
			<h4><?php echo $item->get('title'); ?></h4>
			<span class="type"><?php echo $item->get('category_label'); ?></span>
		</li>
	</a>
	<?php endforeach; ?>
</ul>