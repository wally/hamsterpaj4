<h1 class="entertain_head">Skapa nytt objekt <strong>Entertain</strong></h1>

<p>
	Här skapar du ett objekt i vårt underhållningssystem och väljer vad för typ av objekt det är.
	Du kommer inte att kunna ändra vilken typ av objekt det är längre fram. Nedan kan du läsa lite om de olika
	objekten. Tänk på att det vilket objekt du väljer inte har någon koppling till vad för kategori den ska ligga i.
</p>

<p>
	Objektet som skapas kommer markeras som dolt, på nästa sida får du möjlighet att redigera det.
</p>

<div id="step">
	<form class="entertain_form" method="post">
		<div id="object_name">
			<label for="entertain_create_name">Namn</label><br />
			<input type="text" name="title" id="entertain_create_name" /><br />
		</div>
	
		<div id="object_type">
			<label for="entertain_create_type">Typ</label><br />
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
			<option value="video">Video</option>
		</select>
		</div>
		<div id="object_category">
			<label>Kategori</label><br />
			<?php echo $dropdown->render(); ?>
		</div>
		
		<input class="hp_button" type="submit" value="Skapa" />
	</form>

</div>