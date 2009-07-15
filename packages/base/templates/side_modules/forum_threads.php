<a class="minimize" href="#">+</a><h5>Nya tr&aring;dar</h5>
<ul>
	<?php foreach($module->threads as $thread) : ?>
		<li >
			<?php	$thread['title'] = (mb_strlen($thread['title'], 'UTF8') > 22) ? mb_substr($thread['title'], 0, 22, 'UTF8') . '...' : $thread['title']; ?>
			<?php $info = 'I ' . $thread['category_title'] . ' av ' . $thread['username'] . ': ' . $thread['title']; ?>
			<span class="ui_module_latest_posts_written"><?php echo date('H:i', $thread['last_post_timestamp']); ?></span>
			<a title="<?php echo $info; ?>" href="<?php echo $thread['url']; ?>"><?php echo $thread['title']; ?></a>
		</li>
	<?php endforeach; ?>
</ul>