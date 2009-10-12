<div class="entertain_preview_full">
	<a href="<?php echo $item->get('url'); ?>">
		<h2><?php echo $item->get('title'); ?></h2>
		<img src="<?php echo $item->preview_image('full'); ?>"  alt="<?php echo entertain::get_category_label($item->category) . ': ' .$item->get('title'); ?>" />
	</a>
</div>