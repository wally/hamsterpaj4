<ul id="main_menu">
    <?php foreach($bigmenu AS $handle => $current_menu): ?>
	<li class="direct_child <?php echo @$was_active ? 'after_active' : ''; ?> <?php echo (Tools::pick($current_menu['type'], '') == 'big') ? 'big' : 'small'; ?>" <?php echo Tools::is_true($current_menu['active']) ? 'id="active"' : ''; ?>>
		<a class="direct_child" href="<?php echo $current_menu['url']; ?>">
			<?php echo $current_menu['label']; ?>
		</a>
		
		<?php //if (count($current_menu['sub']) > 0): ?>
		<ul class="main_menu_sub <?php echo Tools::is_true($current_menu['active']) ? 'active_sub' : ''; ?>">
			<?php foreach ( $submenu[$handle] as $current_submenu ): ?>
				<li class="<?php echo Tools::choose($current_submenu['active'], 'active', ''); ?>">
					<a href="<?php echo $current_submenu['url']; ?>"><?php echo $current_submenu['label']; ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php //endif; ?>
	</li>
	<?php $was_active = Tools::is_true($current_menu['active']); ?>
    <?php endforeach ?>
</ul>