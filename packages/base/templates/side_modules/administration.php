<?php if($abuses > 0): ?>
<a href="/admin/abuse.php">
	<?php echo $abuses; ?> nya rapporter »
</a>
<?php endif; ?>

<?php if($avatar_validates > 0): ?>
<br>----------------------<br>
<a href="/admin/avatarer.php">
	<?php echo $avatar_validates; ?> nya bilder att validera »
</a>
<?php endif; ?>

<?php if($gb_autoreports > 0): ?>
<br>----------------------<br>
<a href="/admin/gb_autoreport.php">
	<?php echo $gb_autoreports; ?> nya automatiska GB-rapporter »
</a>
<?php endif; ?>