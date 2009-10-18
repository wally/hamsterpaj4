<div id="notices">
	<ul>
		<?php $class = ($user->get('unread_gb_entries') > 0) ? ' class="active"' : ''; ?>
		<li class="notice_panel" id="notices_guestbook"<?php echo $class; ?>>
			<a class="notice_icon" href="/traffa/guestbook.php?user_id=3">
			<?php if($user->get('unread_gb_entries') == 1) : ?>
				1 nytt inlägg
			<?php elseif($user->get('unread_gb_entries') > 1) : ?>
				<?php echo $user->get('unread_gb_entries'); ?> nya inlägg
			<?php else : ?>
				Gästbok
			<?php endif; ?>
			</a>
		</li>
		
		<li class="notice_panel" id="notices_forum">
			<a class="notice_icon" id="ui_noticebar_forum" class="ui_noticebar_active" href="/diskussionsforum/notiser.php">Forum</a>
		</li>
		
		<li class="notice_panel" id="notices_groups">
			<a class="notice_icon" id="ui_noticebar_groups"  href="/traffa/groupnotices.php">Grupper</a>
			<div class="notices_information" />
		</li>
		
		<li class="notice_panel" id="notices_events">
			<a class="notice_icon" id="ui_noticebar_events" href="/traffa/events.php">Händelser</a>
		</li>
	</ul>
</div>