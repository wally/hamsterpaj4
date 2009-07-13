<h2>Flashfil</h2>
<ul>
	<?php if(file_exists('/mnt/static/entertain/flash/' . $item->handle . '.swf')): ?>
	<li>
		<input type="radio" name="flashfile_action" value="noaction" id="flashfile_noaction" checked="true" />
		<label for="flashfile_noaction">Behåll aktuell flashfil</label>
	</li>
	<?php endif; ?>
	<li>
		<input type="radio" name="flashfile_action" value="upload" id="flashfile_upload" />
		<label for="flashfile_upload">Ladda upp ny flashfil</label>
		<input type="file" name="flashfile_upload" />
	</li>
	<li>
		<input type="radio" name="flashfile_action" value="wget" id="flashfile_wget" />
		<label for="flashfile_wget">Hämta flashfil från webben</label>
		<input type="text" name="flashfile_url" />
	</li>
</ul>
	