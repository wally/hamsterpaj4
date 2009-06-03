<ul class="entertain_preview">
	<?php foreach($items AS $item) : ?>
	<a href="<?php $item->get('url'); ?>">
		<li>
			<img src="http://static.hamsterpaj.net/images/entertain/items/bloons_tower_defense_3/preview_medium.png" />
			<h4><?php echo $item->get('name'); ?></h4>
			<span class="type">Onlinespel</span>
		</li>
	</a>
	<?php endforeach; ?>
</ul>