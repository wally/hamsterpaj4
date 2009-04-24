<dl id="debug">
	<?php global $_DEBUG; ?>
	<?php foreach($_DEBUG AS $debug) : ?>
		<dt><?php echo $debug['title']; ?></dt>
			<dd>
				<?php echo $debug['text']; ?>
			</dd>
	<?php endforeach; ?>
</dl>