<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="action" value="scale" />
	<input type="hidden" name="handle" value="<?php echo $handle; ?>" />
	<h2>Ladda upp en ny bild</h2>
	<input type="file" name="preview" />
	<input type="submit" value="Ladda upp" />
</form>