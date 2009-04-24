<?php debug('Statistics template'); ?>
<h5>Statistik</h5>
<dl>
	<dt>Besökare</dt>
		<dd><?php echo $page->visitors; ?></dd>
	<dt>Inloggade</dt>
		<dd><?php echo $page->logged_in; ?></dd>
	<dt>Medlemmar</dt>
		<dd><?php echo $page->members; ?></dd>
	<dt>Sidvisningar idag</dt>
		<dd><?php echo $page->pageviews; ?></dd>
</dl>