<h5>Besökare</h5>
<ul>
	<?php foreach($page->visitors AS $visitor) : ?>
		<li>
			YO
			<a href="/traffa/profile.php?id=' . $visitor['id'] . '" title="' . $visitor['username'] . ' besökte dig ' . strtolower(fix_time($visitor['timestamp'])) . '">
			<img src="http://images.hamsterpaj.net/images/users/thumb/' . $visitor['id'] . '.jpg" />
			</a>
		</li>
	<?php endforeach; ?>
</ul>
<a href="/traffa/my_visitors.php" class="show_more_link">Visa fler &raquo;</a>