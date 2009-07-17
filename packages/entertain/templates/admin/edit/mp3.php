<h3>Datatyp: MP3-fil</h3>
<ul>
	<?php if(file_exists('/mnt/static/entertain/mp3/' . $item->handle . '.mp3')): ?>
	<li>
		<input type="radio" name="mp3_action" value="noaction" id="mp3_noaction" checked="true" />
		<label for="mp3_noaction">Behåll aktuell mp3</label>
	</li>
	<?php endif; ?>
	<li>
		<input type="radio" name="mp3_action" value="upload" id="mp3_upload" />
		<label for="mp3_upload">Ladda upp ny mp3</label>
		<input type="file" name="mp3_upload" />
	</li>
	<li>
		<input type="radio" name="mp3_action" value="wget" id="mp3_wget" />
		<label for="mp3_wget">Hämta mp3 från webben</label>
		<input type="text" name="mp3_url" />
	</li>
</ul>
	