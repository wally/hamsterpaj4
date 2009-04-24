<ul>
	<?php foreach($page->menu AS $menu) : ?>
	<li>
		<a href="<?php echo $menu['url']; ?>" class="root-a"><?php echo $menu['label']; ?></a>
		<ul>
			<li><a href="<?php echo $menu['url']; ?>">Start</a></li>
			<?php foreach($menu['children'] AS $child) : ?>
			<li><a href="<?php echo $child['url']; ?>"><?php echo $child['label']; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</li>
	<?php endforeach; ?>
</ul>