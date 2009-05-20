<h1>Vilken musik <strong>diggar</strong> du?</h1>

<?php echo template('pages/misc/digga/dig_form.php'); ?>

<p>
	<strong>Digga är</strong> ett sätt att visa andra vad du gillar för musik - och träffa andra som har
	likadan musiksmak som du. Digga skapas tillsammans av oss som använder Hamsterpaj.
</p>

<h2>Nya artister</h2>
<div class="digga_start_latest">
	<?php foreach($recent_artists AS $artist) : ?>
		<?php echo template('pages/misc/digga/artist_mini.php', array('artist' => $artist)); ?>
	<?php endforeach; ?>
</div>

<h2>Vilken musik <strong>diggas</strong> mest just nu?</h2>
<?php echo template('pages/misc/digga/artist_battle.php', array('artists' => $top_artists)); ?>

<?php if($user->exists()) : ?>
	<h2>Din <strong>musiksmak</strong> just nu</h2>
	<div class="digga_start_user_idols">
		<?php foreach($user_idols AS $artist) : ?>
			<?php echo template('pages/misc/digga/artist_mini.php', array('artist' => $artist)); ?>
		<?php endforeach; ?>
	</div>
	
	<img src="http://images.hamsterpaj.net/photos/full/46/233787.jpg" />
	<p>
		<strong style="color: red;">FUNKAR INTE!</strong>
	</p>
	<p>
		<strong>BETA:</strong> Bilden visar en sammanställnign av de artister du diggar för tillfället.
		Artisterna klassas av sina fans - är du inte helt nöjd kan du visa hur du tycker att artisten är
		genom att gå in på artistens sida!
	</p>
<?php endif; ?>

<h1>Vad tycker <strong>du</strong> om Digga?</h1>
<ul>
	<li><a href="/">Skriv i forumet</a></li>
	<li><a href="/traffa/guestbook.php?user_id=3">Skriv i Johans gästbok</a> (Inte säkert att du får svar...)</li>
</ul>

<h2>Stor, fet BETA-varning på detta!</h2>


