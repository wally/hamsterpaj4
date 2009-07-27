<p>Det här fungerar bara på bilddagböcker där användaren inte kräver vänskap</p>

<form method="post">
  <label for="text">Länk till sidan med bilden på Bilddagboken</label>
  <input type="text" name="url" />
  <input type="submit" value="Hämta bilden" />
</form>

<?php if(isset($image_url)): ?>
<h2>Bilden</h2>
<img src="<?php echo $image_url; ?>" />

<h2>Länk till bilden</h2>
<a href="<?php echo $image_url; ?>"><?php echo $image_url; ?></a>
<?php endif; ?>