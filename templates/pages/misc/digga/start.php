<div class="digga_start">
	<h1>Vilken musik <strong>diggar</strong> du?</h1>
	
	
	<?php echo template('pages/misc/digga/dig_form.php'); ?>
	
	<h2>Nya artister</h2>
	<div class="digga_start_latest">
		<?php foreach($recent_artists AS $artist) : ?>
			<?php echo template('pages/misc/digga/artist_mini.php', array('artist' => $artist)); ?>
		<?php endforeach; ?>
	</div>
	<a href="/digga/alla-artister">Visa alla artister</a>
	
	
	<h2>Vilken musik <strong>diggas</strong> mest just nu?</h2>
	<?php echo template('pages/misc/digga/artist_battle.php', array('artists' => $top_artists)); ?>
	
	<div style="clear: both;"></div>
	
	<?php if($user->exists()) : ?>
		<h2>Din <strong>musiksmak</strong> just nu</h2>
		<div class="digga_start_user_idols">
			<?php foreach($user_idols AS $artist) : ?>
				<?php echo template('pages/misc/digga/artist_mini.php', array('artist' => $artist)); ?>
			<?php endforeach; ?>
		</div>
		<img src="/digga/graph?nonsense<?php echo $music_taste_graph; ?>" />

		<p>
			Bilden visar en sammanställning av de artister du diggar.
			Artisterna klassas av sina fans - du kan själv visa hur du tycker att artisten låter
			på artistens sida!
		</p>
	<?php endif; ?>
</div>

