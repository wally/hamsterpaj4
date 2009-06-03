<ul class="mobile_blog_list">
	<?php foreach($entries AS $entry): ?>
		<?php echo template('pages/social/mobile_blog/post.php', $entry); ?>
	<?php endforeach; ?>
</ul>