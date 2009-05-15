<h1>Vilken musik <strong>diggar</strong> du?</h1>

<?php echo template('pages/misc/digga/dig_form.php'); ?>

<p>
	<strong>Digga är</strong> ett sätt att visa andra vad du gillar för musik - och träffa andra som har
	likadan musiksmak som du. Digga skapas tillsammans av oss som använder Hamsterpaj.
</p>

<h2>Nya artister</h2>
<p>
	<?php foreach($recent_artists AS $artist) : ?>
		<a href="<?php echo $artist->get('url'); ?>"><?php echo $artist->get('name'); ?></a>
	<?php endforeach; ?>
</p>

<h2>Mest <strong>diggade</strong> artisterna</h2>
<?php echo template('pages/misc/digga/top_list.php', array('artists' => $top_artists)); ?>

<h2>Din musiksmak just nu</h2>
<img src="http://images.hamsterpaj.net/photos/full/46/233787.jpg" />
<p>
	<stron style="color: red;">FUNKAR INTE!</strong>
</p>
<p>
	<strong>BETA:</strong> Bilden visar en sammanställnign av de artister du diggar för tillfället.
	Artisterna klassas av sina fans - är du inte helt nöjd kan du visa hur du tycker att artisten är
	genom att gå in på artistens sida!
</p>

<h1>Vad tycker <strong>du</strong> om Digga?</h1>
<ul>
	<li><a href="/">Skriv i forumet</a></li>
	<li><a href="/traffa/guestbook.php?user_id=3">Skriv i Johans gästbok</a> (Inte säkert att du får svar...)</li>
</ul>

<h2>Stor, fet BETA-varning på detta!</h2>


