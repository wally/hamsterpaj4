<form action="/digga/ny-digga" method="post" class="digga_form">
	<fieldset>
		<?php if($create == true) : ?>
			<legend>Lägg till artist i Digga</legend>
		<?php endif; ?>
		<label>Artist eller grupp</label>
		<input type="text" name="artist" <?php echo (isset($artist)) ? 'value="' . $artist . '" ' : ''; ?> />
		<input type="submit" value="Börja digga!" />
		<small>Ex. In Flames, Fronda</small>
		<?php if($create == true) : ?>
			<p>Tänk på att kontrollera stavningen noga!</p>
			<input type="hidden" name="create" value="true" />
		<?php endif; ?>
	</fieldset>
</form>

