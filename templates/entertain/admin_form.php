<h1>Skapa nytt objekt <em>Entertain</em></h1>
<form method="post">
	<label for="entertain_create_name">Namn</label>
	<input type="text" name="title" id="entertain_create_name" />

	<label for="entertain_create_type">Typ</label>
	<select name="type" id="entertain_create_type">
		<option value="text">Text</option>
		<option value="web">Webb-länk</option>
		<option value="iframe">Iframe</option>
		<option value="html">HTML-kod</option>
		<option value="flash">Flash</option>
		<option value="image">Bild</option>
		<option value="preformatted">För-formatterad</option>
		<option value="file">Nedladdningsbar fil</option>
		<option value="mp3">Musik</option>
	</select>
	
	<input type="submit" value="Skapa" />
</form>

<p>
	Här skapar du ett objekt i Entertain och väljer vad för typ av objekt det är.
	Objektets handle (som används i webbadressen) kommer också att skapas.
	Varken handle eller typ kommer att kunna ändras längre fram.
</p>

<p>
	Objektet som skapas kommer markeras som dolt, på nästa sida får du möjlighet att redigera det.
</p>