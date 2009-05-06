<div id="notices">
	<ul>
		<?php $class = ($user->get('unread_gb_entries') > 0) ? ' class="active"' : ''; ?>
		<li id="notices_guestbook"<?php echo $class; ?>>
			<a href="/traffa/guestbook.php?user_id=3">
			<?php if($user->get('unread_gb_entries') == 1) : ?>
				1 nytt inlägg
			<?php elseif($user->get('unread_gb_entries') > 1) : ?>
				<?php echo $user->get('unread_gb_entries'); ?> nya inlägg
			<?php else : ?>
				Gästbok
			<?php endif; ?>
			</a>
		</li>
		
		<li id="notices_forum">
			<a id="ui_noticebar_forum" class="ui_noticebar_active" href="/diskussionsforum/notiser.php">Forum</a>
		</li>
		<li id="notices_groups">
			<a id="ui_noticebar_groups"  href="/traffa/groupnotices.php">Grupper</a>
		</li>
		<li id="notices_events">
			<a id="ui_noticebar_events" href="/traffa/events.php">Händelser</a>
		</li>
	</ul>
</div>