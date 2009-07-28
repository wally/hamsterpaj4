<p>Det här fungerar bara på bilddagböcker där användaren inte kräver vänskap</p>

<h2>Hämta bilden trots kopieringsskydd</h2>
<form method="post">
  <label for="text">Länk till sidan med bilden på Bilddagboken</label>
  <input type="text" name="url" />
  <input type="submit" name="one_image" value="Hämta bilden" />
</form>

<h2>Hämta -ALLA- bilder från en användare</h2>
<form method="post">
  <label for="text">Användarnamn på Bilddagboken</label>
  <input type="text" name="username" />
  <input type="submit" name="all_images" value="Hämta bilder" />
</form>

<h2>Hämta en komprimerad fil med alla bilder från en användare</h2>
<form method="post">
  <label for="text">Användarnamn på Bilddagboken</label>
  <input type="text" name="username" />
  <input type="submit" name="download_zip" value="Hämta bilder" />
</form>