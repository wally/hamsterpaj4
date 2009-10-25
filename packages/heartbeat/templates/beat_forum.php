<h4><a href="/discussionsforum/notiser.php">Dina forumnotiser (<span><?php echo $unread; ?></span>)</a></h4>

<?php if ( $unread > 0 ): ?>
    <?php if ( count($subscriptions) ): ?>
    <h5>Bevakade tr&aring;dar</h5>
    <ul>
	<?php $counter = new Counter('n1', 'n2'); ?>
	<?php foreach ( $subscriptions as $thread ): ?>
	<li class="<?php echo $counter; ?>"><a href="<?php echo $thread['url']; ?>"><?php echo $thread['title']; ?> (<strong><?php echo $thread['unread_posts']; ?> nya</strong>)</a></li>
	<?php endforeach; ?>
    </ul>
    <?php endif; ?>
    
    <?php if ( count($forum_subscriptions) ): ?>
    <h5>Nya tr&aring;dar i bevakade kategorier</h5>
    <ul>
	<?php $counter = new Counter('n1', 'n2'); ?>
	<?php foreach ( $forum_subscriptions as $category ): ?>
	<li class="<?php echo $counter; ?>"><a href="/diskussionsforum/<?php echo $category['handle']; ?>/"><?php echo $category['title']; ?> (<strong><?php echo $category['new_threads']; ?> nya</strong>)</a></li>
	<?php endforeach; ?>
    </ul>
    <?php endif; ?>
    
    <?php if ( count($notices) ): ?>
    <h5>Svar fr&aring;n annat trevligt folk</h5>
    <ul>
	<?php $counter = new Counter('n1', 'n2'); ?>
	<?php foreach ( $notices as $post ): ?>
	<li class="<?php echo $counter; ?>"><a href="/diskussionsforum/gaa_till_post.php?post_id=<?php echo $post['post_id']; ?>"><?php echo $post['title']; ?>, av <?php echo $post['username']; ?></a></li>
	<?php endforeach; ?>
    </ul>
    <?php endif; ?>
<?php else: ?>
<h5 class="nothing-new">Inget nytt!</h5>
<?php endif; ?>

<div class="beat-footer"></div>