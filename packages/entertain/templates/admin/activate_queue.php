<h1>Objekt som behövs godkännas, Antal: <?php echo count($items); ?></h1>
<ul>
	<?php foreach($items AS $item): ?>
	<li>
		<a href="<?php echo $item->get_edit_url(); ?>"><?php echo $item->get('title'); ?></a>
	</li>
	<?php endforeach; ?>
</ul>
