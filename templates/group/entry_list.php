<ul class="group_entry_list">
<?php foreach($entries AS $entry) : ?>
	<?php $author = $entry->get('author'); ?>
	<li>
		<?php echo template('framework/user_profile_mini.php', array('user' => $author)); ?>
		<p>
			<?php echo $entry->get('text'); ?>
		</p>
		<br style="clear: both;" />
	</li>
<?php endforeach; ?>
</ul>