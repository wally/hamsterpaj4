<ul id="main_menu">
    <?php foreach($bigmenu AS $handle => $current_menu): ?>
	<li class="<?php echo (isset($current_menu['type']) && $current_menu['type'] == 'big') ? 'big' : 'small'; ?>" <?php echo Tools::is_true($current_menu['active']) ? 'id="active"' : ''; ?>>
		<a href="<?php echo $current_menu['url']; ?>">
			<?php echo $current_menu['label']; ?>
		</a>
	</li>
    <?php endforeach ?>
</ul>

<?php if (count($submenu) > 0): ?>
<ul id="main_menu_sub">
	<?php foreach($submenu AS $current_submenu): ?>
		<li>
			<a href="<?php echo $current_submenu['url']; ?>">
				<?php echo Tools::choose($current_submenu['active'], '<strong>', ''); ?>
					<?php echo $current_submenu['label']; ?>
				<?php echo Tools::choose($current_submenu['active'], '</strong>', ''); ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>