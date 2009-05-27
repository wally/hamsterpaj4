<h1>Alla artister i <a href="/digga">Digga</a></h1>
<div class="digga_all_artists">
	<?php foreach($artists AS $artist) : ?>
		<?php if($lead_letter != strtoupper(mb_substr($artist->get('name'), 0, 1))) : ?>
			<h1><?php echo strtoupper(mb_substr($artist->get('name'), 0, 1)); ?></h1>
			<?php $lead_letter = strtoupper(mb_substr($artist->get('name'), 0, 1)); ?>
		<?php endif; ?>
		<?php echo template('pages/misc/digga/artist_mini.php', array('artist' => $artist)); ?>
	<?php endforeach; ?>
</div>