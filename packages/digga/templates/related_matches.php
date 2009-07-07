<form>
	<fieldset>
		<legend>Välj en artist med liknande namn</legend>
		<select name="artist">
			<?php foreach($artists AS $artist) : ?>
				<option value="<?php echo $artist->get('name'); ?>"><?php echo $artist->get('name'); ?></option>
			<?php endforeach; ?>
		</select>
		<input type="submit" value="Börja digga!" />
	</fieldset>
</form>