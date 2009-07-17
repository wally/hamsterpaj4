<h1>Topplista för <?php echo $category_label; ?></h1>

<div class="entertain_preview_container">
	<h2>Mest visningar</h2>
	<?php echo entertain::previews($most_views); ?>
	<br class="clear" />
</div>

<div class="entertain_preview_container">
	<h2>Med bäst betyg</h2>
	<?php echo entertain::previews($best_rating); ?>
	<br class="clear" />
</div>

<br class="clear" /><a href="/entertain/ny">Ladda upp nya objekt</a>