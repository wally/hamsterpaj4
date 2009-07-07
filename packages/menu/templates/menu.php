<ul id="main_menu">
<?php foreach($data AS $handle => $current_menu): ?>
	<?php if($current_menu['type'] == 'big'): ?>
		<li class="big">
			<a href="/<?php echo $current_menu['url'] ?>">
				<?php echo $current_menu['label'] ?>
			</a>	
		</li>
	<?php else: ?>
		<li class="small">
			<a href="/<?php echo $current_menu['url'] ?>">
				<?php echo $current_menu['label'] ?>
			</a>
		</li>
	<?php endif ?>
<?php endforeach ?>
</ul>

<ul id="main_menu_sub">
	<li><a href="/alfabetet-paa-tid">&raquo; Alfabetet på tid</a></li>
	<li><a href="/digga">&raquo; Digga</a></li>
	<li><a href="/gratis-musik">&raquo; Gratis musik</a></li>
</ul>
