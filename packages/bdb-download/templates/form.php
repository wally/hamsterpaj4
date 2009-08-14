<h1 id="bdb-download-h1">Hämta bilder från Bilddagboken.se</h1>

<div id="bdb-download-form">
	<h2>Hämta bilden trots kopieringsskydd</h2>
		<form method="post" action="/bilddagboken/submit" <?php echo (isset($url) ? 'style="display: block"' : ''); ?>>
		  <label for="text">Länk till sidan med bilden på Bilddagboken</label>
		  <input type="text" name="url" <?php echo (isset($url) ? 'value="' . $url . '"' : ''); ?> />
		  <input type="submit" name="image" value="Hämta bilden" class="hp_button" />
		</form>
	
	<h2>Hämta -ALLA- bilder från en användare</h2>
		<form method="post" action="/bilddagboken/submit" <?php echo (isset($username) ? 'style="display: block"' : ''); ?>>
		  <label for="text">Användarnamn på Bilddagboken</label>
		  <input type="text" name="username" <?php echo (isset($username) ? 'value="' . $username . '"' : ''); ?> />
		  <input type="submit" name="user" value="Hämta bilder" class="hp_button" />
		</form>
	
	<h2>Hämta en komprimerad fil med alla bilder från en användare</h2>
		<form method="post" action="/bilddagboken/submit" <?php echo (isset($username_zip) ? 'style="display: block"' : ''); ?>>
		  <label for="text">Användarnamn på Bilddagboken</label>
		  <input type="text" name="username" <?php echo (isset($username_zip) ? 'value="' . $username_zip . '"' : ''); ?> />
		  <input type="submit" name="download_zip" value="Hämta bilder" class="hp_button" />
		</form>
</div>