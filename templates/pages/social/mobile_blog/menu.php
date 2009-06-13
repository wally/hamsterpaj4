<div class="mobile_blog_menu">
	<ul>
		<li><a href="/mobilblogg">&raquo; Kom igång med mobilbloggen</a></li>
		<?php if($user->exists()): ?>
			<li><a href="/<?php echo $user->username; ?>/mobilblogg"> &raquo; Visa dina bloggningar</a></li>
		<?php endif; ?>
		<li><a href="/mobilblogg/lista">&raquo; Andra användare som har bloggat</a></li>
		<li><a href="/mobilblogg/installningar">&raquo; Inställningar</a></li>
	</ul>
</div>