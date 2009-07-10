<?php $data = $item->get('data'); ?>
<?php tools::debug($item); ?>
<div class="entertain_view">
	<h1><?php echo $item->get('title'); ?></h1>
	<object width="550" height="400">
		<param name="movie" value="<?php echo $data['flashfile']; ?>">
		<embed src="<?php echo $data['flashfile']; ?>" width="550" height="400"></embed>
	</object>
</div>
