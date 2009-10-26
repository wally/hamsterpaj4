<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="action" value="scale" />
	<input type="hidden" name="handle" value="<?php echo $handle; ?>" />
	<h2>Ladda upp en ny bild</h2>
	<ul>
		<li>
			<input type="radio" name="upload_action" value="upload" id="upload" />
			<label for="upload">Ladda upp ny bild</label>
			<input type="file" name="preview" />
		</li>
		<li>
			<input type="radio" name="upload_action" value="wget" id="wget" />
			<label for="wget">Hämta bild från webben</label>
			<input type="text" name="url" <?php echo file_exists('/mnt/static/entertain/images/' . $handle . '.jpg') ? 'value="http://static.hamsterpaj.net/entertain/images/' . $handle . '.jpg' . '"' : ''; ?> />
		</li>
	</ul>
	<input type="submit" value="Ladda upp" />
</form>
