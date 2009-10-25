<div id="notices">
	<ul>
		<?php $class = ($user->get('unread_gb_entries') > 0) ? ' active"' : ''; ?>
		<li class="notice_panel<?php echo $class; ?>" id="notices_guestbook">
			<a class="notice_icon" href="/traffa/guestbook.php?user_id=3">
			    <?php echo String::plural($user->get('unread_gb_entries'), 'Gästbok', '1 ny', '%d nya'); ?>
			</a>
		</li>
		
		<?php $unread = $user->get('unread_forum_posts'); ?>
		<li class="notice_panel <?php echo ($unread > 0) ? 'active' : ''; ?>" id="notices_forum">
			<a class="notice_icon" id="ui_noticebar_forum" href="/diskussionsforum/notiser.php">
			    <?php echo String::plural($unread, 'Forum', '1 ny', '%d nya'); ?>
			</a>
			
			<div class="notices_information">
			    <?php echo PageHeartbeat::run_hook('forum', $page); ?>
			</div>
		</li>
		
		<?php $unread = $user->get('unread_group_entries'); ?>
		<li class="notice_panel <?php echo ($unread == 0) ? '': ' active'; ?>" id="notices_groups">
			<a class="notice_icon" id="ui_noticebar_groups"  href="/traffa/groupnotices.php">
			    <?php echo String::plural($unread, 'Grupper', '1 ny', '%d nya'); ?>
			</a>
			
			<div class="notices_information">
			    <?php echo PageHeartbeat::run_hook('groups', $page); ?>
			</div>
		</li>
		
		<?php
		    $unread = $user->get('unread_photo_comments');
		    $total = count($unread);
		?>
		<li class="notice_panel <?php echo $total > 0 ? 'active' : ''; ?>" id="notices_events">
			<a class="notice_icon" id="ui_noticebar_events" href="/traffa/events.php">
			    <?php echo String::plural($total, 'Händelser', '1 ny', '%d nya'); ?>
			</a>
			
			<div class="notices_information">
			    <?php echo PageHeartbeat::run_hook('events', $page); ?>
			</div>
		</li>
	</ul>
</div>