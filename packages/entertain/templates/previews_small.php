<ul class="entertain_preview_small">
	<?php foreach($items AS $item) : ?>
	
		<li>
			<a href="<?php echo $item->get('url'); ?>">
			<img src="<?php echo $item->preview_image('medium'); ?>" alt="<?php echo Entertain::get_category_label($item->category) . ': ' .$item->get('title'); ?>" />
			<h4><?php echo $item->get('title'); ?></h4>
			</a>
		</li>
	
	<?php endforeach; ?>
</ul>
<div class="clear"></div>