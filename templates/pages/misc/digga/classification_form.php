<?php tools::debug($classifications); ?>
<h2>Hur låter <?php echo $artist->get('name'); ?>?</h2>
<form action="<?php $artist->get('url'); ?>" method="post" class="digga_classification_form">
	<input type="hidden" name="action" value="classify" />
	<p>
		<label class="classification_label">Stil</label>
		<label>Lite</label>
		<label>Mycket</label>
	</p>
	<ul>
		<?php for($i = 0; $i < 5; $i++) : ?>
			<?php $class = array_pop($classifications); ?>
			<li>
				<select name="classification_<?php echo $i; ?>">
				<?php foreach(artist::all_classifications() AS $id => $name) : ?>
					<?php $selected = (isset($class['id']) && $id == $class['id']) ? ' selected="true"' : null; ?>
					<option value="<?php echo $id; ?>"<?php echo $selected; ?>><?php echo $name; ?></option>
				<?php endforeach; ?>	
				</select>
				<?php for($j = 0; $j < 4; $j++) : ?>
					<?php $checked = (isset($class['value']) && $j == $class['value']) ? ' checked="true"' : null; ?>
					<input type="radio" name="value_<?php echo $i; ?>" value="<?php echo $j; ?>"<?php echo $checked; ?> />
				<?php endfor; ?>
			</li>
		<?php endfor; ?>
	</ul>
	<input type="submit" value="Spara" />
</form>



