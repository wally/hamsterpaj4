<ul id="main_menu">
    <?php foreach($bigmenu AS $handle => $current_menu): ?>
	<?php /* onmouseover/onmouseout are so we dont have to add the handlers on document.ready, so they always respond */ ?>
	<li id="<?php echo $handle; ?>" onmouseover="hp.menu.over(event, this);" onmouseout="hp.menu.out(event, this);" class="<?php echo Tools::is_true($current_menu['active']) ? 'active_menu the_active' : ''; ?> direct_child <?php echo Tools::pick($was_active, false) ? 'after_active' : ''; ?> <?php echo (Tools::pick($current_menu['type'], '') == 'big') ? 'big' : 'small'; ?>">
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