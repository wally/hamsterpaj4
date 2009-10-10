<dl id="debug">
	<h3>Felsökningsinfo</h3>
	<p>
		Vissa inloggningar tycks gå sönder efter att
		man besökt en Daniella-sida. Om Hamsterpaj slutar fungera
		kan du behöva logga ut och sedan in igen!
	</p>
	<?php global $_DEBUG, $_TIMER; ?>
	
	<?php foreach(tools::ensure_array($_TIMER) AS $event): ?>
		<dt><?php echo $event['point']; ?></dt>
		<dd>
			<?php echo (isset($last_time)) ? '+ ' . ($event['time'] - $last_time) . 's' : date('H:i:s', $event['time']); ?>
		</dd>
		<?php $last_time = $event['time']; ?>
	<?php endforeach; ?>
	
	<?php foreach($_DEBUG AS $debug): ?>
		<dt><?php echo $debug['title']; ?></dt>
		<dd>
			<?php echo $debug['text']; ?>
		</dd>
	<?php endforeach; ?>
</dl>