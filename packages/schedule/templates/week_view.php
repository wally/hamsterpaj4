<table class="schedule_week_view">
	<tr>
		<td></td>
		<?php for($i= 0; $i < 24; $i++) : ?>
			<th colspan="12"><?php echo ($i < 10) ? '0' . $i : $i; ?></th>
		<?php endfor; ?>
	</tr>
	<?php foreach(array('M', 'T', 'O', 'T', 'F', 'L', 'S') AS $d) : ?>
		<tr>
			<th><?php echo $d; ?></th>
			<?php foreach($action AS $action) : ?>
			
			<?php endforeach; ?>

		</tr>
	<?php endforeach; ?>
</table>