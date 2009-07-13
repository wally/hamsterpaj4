<?php $data = $item->get('data'); ?>
<?php tools::debug($item); ?>
<div class="entertain_view">
	<h1><?php echo $item->get('title'); ?></h1>
	<object width="638" height="500px">
		<param name="movie" value="<?php echo $data['flashfile']; ?>">
		<embed src="<?php echo $data['flashfile']; ?>" width="638" height="500px"></embed>
	</object>
</div>
