<ul id="main_menu">
<?php foreach($bigmenu AS $handle => $current_menu): ?>
	<?php if($current_menu['type'] == 'big'): ?>
		<li class="big" <?php echo tools::is_true($current_menu['active']) ? 'id="active"' : ''; ?>>
			<a href="<?php echo $current_menu['url'] ?>">
				<?php echo $current_menu['label'] ?>
			</a>	
		</li>
	<?php else: ?>
		<li class="small" <?php echo tools::is_true($current_menu['active']) ? 'id="active"' : ''; ?>>
			<a href="<?php echo $current_menu['url']; ?>">
				<?php echo $current_menu['label']; ?>
			</a>
		</li>
	<?php endif ?>
<?php endforeach ?>
</ul>

<?php if(count($submenu) > 0): ?>
<ul id="main_menu_sub">
	<?php foreach($submenu AS $current_submenu): ?>
		<li>
			<a href="<?php echo $current_submenu['url']; ?>">
				<?php echo tools::is_true($current_submenu['active']) ? '<strong>' : ''; ?>
					<?php echo $current_submenu['label']; ?>
				<?php echo tools::is_true($current_submenu['active']) ? '</strong>' : ''; ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>