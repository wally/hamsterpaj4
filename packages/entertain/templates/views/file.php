<div class="entertain_download">
	<img src="<?php echo $data['file_type_icon']; ?>" class="file_type" />
	<h1><?php echo $item->get('title'); ?></h1>
	
	
	<form method="post" action="<?php echo $item->get('url') ?>/ladda_ner">
		<input type="submit" name="truesubmit" value="Ladda ner filen" />
	</form>
	<div class="info">
		<strong>Storlek:</strong> <span><?php echo tools::file_size_readable($data['size'], 0); ?></span><br />
		<strong>ADSL:</strong> <span><?php echo tools::duration_readable(tools::file_download_time($data['size'], 'adsl')); ?></span>
		<strong>Fiber:</strong> <span><?php echo tools::duration_readable(tools::file_download_time($data['size'], 'fiber')); ?></span>
		<strong>3g:</strong> <span><?php echo tools::duration_readable(tools::file_download_time($data['size'], '3g')); ?></span>
	</div>
</div>
<p>
	<?php echo $data['description']; ?>
</p>