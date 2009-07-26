<h3>Datatyp: Fil</h3>

<ul>
	<li>
		<input type="radio" name="file_action" value="noaction" checked="true" id="file_noaction"/>
		<label for="file_noaction">Behåll aktuell fil</label>
	</li>
	<li>
		<input type="radio" name="file_action" value="upload" id="file_upload"/>
		<label for="file_upload">Ladda upp ny fil</label>
		<input type="file" name="file" />
	</li>
	<li>
		<input type="radio" name="file_action" value="wget" id="file_wget" />
		<label for="file_wget">Hämta fil från webben</label>
		<input type="text" name="url" />
	</li>
</ul>

<label for="description">Beskrivning</label>
<textarea name="description" class="file_description"><?php echo $data['description']; ?></textarea>