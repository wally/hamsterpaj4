<h1>Preview upload scale</h1>
<div id="entertain_preview_cropper">
	<img src="/temp/1-hour/<?php echo $filename; ?>" id="entertain_preview_cropper_photo" />

	<ul id="crop_previews" class="entertain_preview">
		<li id="crop_307x72">
			<img alt="Thumbnail Preview" style="position: relative; width: 236px;" src="/temp/1-hour/<?php echo $filename; ?>"/>
		</li>
	</ul>
	
	<form method="post">
		<input type="hidden" name="action" value="save" />
		<input type="hidden" name="filename" value="<?php echo $filename; ?>" />
		<input type="hidden" name="handle" value="<?php echo $handle; ?>" />
		<input type="hidden" name="307x72_x1" id="307x72_x1" />
		<input type="hidden" name="307x72_x2" id="307x72_x2" />
		<input type="hidden" name="307x72_y1" id="307x72_y1" />
		<input type="hidden" name="307x72_y2" id="307x72_y2" />
		<input type="submit" value="Spara" />
	</form>

</div>