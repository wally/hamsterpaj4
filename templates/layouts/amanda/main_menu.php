<?php 
	$uri_parts = explode('/', $_SERVER['REQUEST_URI']); 
	$uri = $uri_parts[1]; 
?>
HEHEJEJEHEJHJEHJE
<ul id="main_menu">
<?php global $menu;
    foreach($menu AS $handle => $current_menu): ?>
	<?php if($current_menu['type'] == 'big'): ?>
		<li class="small" <?php if($current_menu['url'] == $uri): ?> id="active"<?php endif ?>>
			<a href="/<?php echo $current_menu['url'] ?>">
				<?php echo $current_menu['label'] ?>
			</a>	
			<?php if($current_menu['url'] == $uri): ?>
				<div class="arrow"></div>
			<?php endif ?>
		</li>
	<?php else: ?>
		<li class="small" <?php if($current_menu['url'] == $uri): ?> id="active"<?php endif ?>>
			<a href="/<?php echo $current_menu['url'] ?>">
				<?php echo $current_menu['label'] ?>
			</a>
			<?php if($current_menu['url'] == $uri): ?>
				<div class="arrow"></div>
			<?php endif ?>
		</li>
	<?php endif ?>
<?php endforeach ?>
</ul>

<ul id="main_menu_sub">
	<li><a href="/alfabetet-paa-tid">&raquo; Alfabetet på tid</a></li>
	<li><a href="/digga">&raquo; sDigga</a></li>
	<li><a href="/gratis-musik">&raquo; Gratis musik</a></li>
</ul>
