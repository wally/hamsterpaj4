<h2>Video</h2>
<ul>
	<?php if(file_exists('/mnt/static/entertain/video/' . $item->handle . '.flv')): ?>
	<li>
		<input type="radio" name="video_action" value="noaction" id="video_noaction" checked="true" />
		<label for="video_noaction">Behåll aktuell flashfil</label>
	</li>
	<?php endif; ?>
	<li>
		<input type="radio" name="video_action" value="upload" id="video_upload" />
		<label for="video_upload">Ladda upp ny flashfil</label>
		<input type="file" name="video_upload" />
	</li>
	<li>
		<input type="radio" name="video_action" value="wget" id="video_wget" />
		<label for="video_wget">Hämta flashfil från webben</label>
		<input type="text" name="video_url" />
	</li>
</ul>
	