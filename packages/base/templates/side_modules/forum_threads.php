<?php $counter = new Counter('odd', 'even'); ?>
<a class="minimize" href="#">+</a><h5>Nya tr&aring;dar</h5><a class="move" href="#">=</a>
<ul>
	<?php foreach($module->threads as $thread) : ?>
		<li class="<?php echo $counter; ?>">
			<?php $thread['title'] = (mb_strlen($thread['title'], 'UTF8') > 22) ? mb_substr($thread['title'], 0, 22, 'UTF8') . '...' : $thread['title']; ?>
			<?php $info = 'I ' . $thread['category_title'] . ' av ' . $thread['username'] . ': ' . $thread['title']; ?>
			<span class="ui_module_latest_posts_written"><?php echo date('H:i', $thread['last_post_timestamp']); ?></span>
			<a title="<?php echo $info; ?>" href="<?php echo $thread['url']; ?>"><?php echo $thread['title']; ?></a>
		</li>
	<?php endforeach; ?>
</ul>

<?php if ( $page->user->exists() ): ?>
<select id="forum_thread_by_category">
    <option value="">Skapa en ny tr&aring;d i kategori</option>
    <?php 
	$categories = Legacy::discussion_forum_categories_fetch(array('parent' => 0));
	echo $module->recurse_forum_category($categories, 0);
    ?>
</select>
<?php endif; ?>