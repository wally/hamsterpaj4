<h1>Nytt objekt i Entertain</h1>

<form class="entertain_admin_form" method="post">
	<input type="hidden" name="action" value="create" />
	<label>Innehållstyp</label>
	<select name="type">
		<option value="text">Text</option>
		<option value="url">URL</option>
		<option value="html">HTML-kod</option>
	</select>
	
	<label>Kategori</label>
	<select name="category">
		<option value="flash">Flashfilm</option>
		<option value="onlinegame">Onlinespel</option>
		<option value="web">Webbsida (iframe)</option>
	</select>
	
	<label>Namn</label>
	<input type="text" name="title" />
	
	<label>Data</label>
	<textarea name="data"></textarea>
	<input type="file" name="image" />
	
	<label>Bild</label>
	<input type="file" name="image" />
	
	<label>Publiceringstid</label>
	<input type="text" name="release" />

	<input type="submit" value="Spara" />
</form>

