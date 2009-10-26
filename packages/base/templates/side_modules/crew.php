<a class="minimize" href="#">+</a><h5>Ordningsvakter</h5>
<ul>
	<?php foreach($module->members as $member): ?>
	<li>
		<a href="<?php echo $member->get('profile_url'); ?>"><?php echo $member->get('username'); ?></a>
	</li>
	<?php endforeach; ?>
</ul>