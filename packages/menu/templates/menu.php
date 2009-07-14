<ul id="main_menu">
<?php foreach($data AS $handle => $current_menu): ?>
	<?php if($current_menu['type'] == 'big'): ?>
		<li class="big" <?php echo $handle == $active ? 'id="active"' : ''; ?>>
			<a href="<?php echo $current_menu['url'] ?>">
				<?php echo $current_menu['label'] ?>
			</a>	
		</li>
	<?php else: ?>
		<li class="small" <?php echo $handle == $active ? 'id="active"' : ''; ?>>
			<a href="<?php echo $current_menu['url'] ?>">
				<?php echo $current_menu['label'] ?>
			</a>
		</li>
	<?php endif ?>
<?php endforeach ?>
</ul>

<ul id="main_menu_sub">
	<?php foreach($submenu AS $current_submenu): ?>
		<li>
			<a href="<?php echo $current_submenu['url'] ?>">
				<?php echo $current_submenu['label'] ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
