<div id="notices">
	<ul>
		<?php $class = ($user->get('unread_gb_entries') > 0) ? ' active"' : ''; ?>
		<li class="notice_panel<?php echo $class; ?>" id="notices_guestbook">
			<a class="notice_icon" href="/traffa/guestbook.php?user_id=3">
			<?php if($user->get('unread_gb_entries') == 1) : ?>
				1 ny
			<?php elseif($user->get('unread_gb_entries') > 1) : ?>
				<?php echo $user->get('unread_gb_entries'); ?> nya inlägg
			<?php else : ?>
				Gästbok
			<?php endif; ?>
			</a>
		</li>
		
		<?php $unread = $user->get('unread_forum_posts'); ?>
		<li class="notice_panel <?php echo ($unread > 0) ? 'active' : ''; ?>" id="notices_forum">
			<a class="notice_icon" id="ui_noticebar_forum" href="/diskussionsforum/notiser.php">
			    <?php if ( $unread == 1 ): ?>
				1 ny
			    <?php elseif ( $unread > 1 ): ?>
				<?php echo $unread; ?> nya
			    <?php else: ?>
				Forum
			    <?php endif; ?>
			</a>
			
			<div class="notices_information">
			    <?php echo PageHeartbeat::run_hook('forum', $page); ?>
			</div>
		</li>
		
		<?php $unread = $user->get('unread_group_entries'); ?>
		<li class="notice_panel <?php echo ($unread == 0) ? '': ' active'; ?>" id="notices_groups">
			<a class="notice_icon" id="ui_noticebar_groups"  href="/traffa/groupnotices.php">
			    <?php if ( $unread == 1 ): ?>
				1 ny
			    <?php elseif ($unread > 1): ?>
				<?php echo $unread; ?> nya
			    <?php else: ?>
				Grupper
			    <?php endif; ?>
			</a>
			<div class="notices_information">
			    <?php echo PageHeartbeat::run_hook('groups', $page); ?>
			</div>
		</li>
		
		<li class="notice_panel" id="notices_events">
			<a class="notice_icon" id="ui_noticebar_events" href="/traffa/events.php">Händelser</a>
		</li>
	</ul>
</div>