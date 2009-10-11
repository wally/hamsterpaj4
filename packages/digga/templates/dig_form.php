<form action="/digga/ny-digga" method="post" class="digga_form">
	<fieldset>
		<?php if(tools::is_true($create)) : ?>
			<legend>Lägg till artist i Digga</legend>
		<?php endif; ?>
		<label>Artist eller grupp</label>
		<input onclick="if(this.value == 'Artist eller grupp. T ex. In Flames, Fronda') this.value='';" onblur="if(this.value.length == 0) this.value='Artist eller grupp. T ex. In Flames, Fronda';" type="text" value="Artist eller grupp. T ex. In Flames, Fronda" name="artist" <?php echo (isset($artist)) ? 'value="' . $artist . '" ' : ''; ?> />
		<input type="submit" value="Börja digga!" />
		<small></small>
		<?php if($create == true) : ?>
			<p>Tänk på att kontrollera stavningen noga!</p>
			<input type="hidden" name="create" value="true" />
		<?php endif; ?>
	</fieldset>
</form>

