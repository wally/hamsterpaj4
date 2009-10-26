<a class="minimize" href="#">+</a><h5>Administration</h5>
<?php if($module->abuses > 0): ?>
<a href="/admin/abuse.php">
	<?php echo $module->abuses; ?> nya rapporter »
</a>
<?php endif; ?>

<?php if($module->avatar_validates > 0): ?>
<br>----------------------<br>
<a href="/admin/avatarer.php">
	<?php echo $module->avatar_validates; ?> nya bilder att validera »
</a>
<?php endif; ?>

<?php if($module->gb_autoreports > 0): ?>
<br>----------------------<br>
<a href="/admin/gb_autoreport.php">
	<?php echo $module->gb_autoreports; ?> nya automatiska GB-rapporter »
</a>
<?php endif; ?>