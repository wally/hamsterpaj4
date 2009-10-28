<h4 value="<?php echo count($photo_comments); ?>"><a href="/traffa/events.php">H&auml;ndelser</a></h4>

<?php if ( count($photo_comments)): ?>
<h5>Fotokommentarer (<?php echo count($photo_comments); ?>)</h5>

<ul id="unread_photo_comments">
    <?php foreach ( $photo_comments as $photo ): ?>
    <li>
	<a href="/fotoblogg/<?php echo $page->user->get('username'); ?>/<?php echo $photo['id']; ?>">
	    <img width="83" src="http://images.hamsterpaj.net/photos/thumb/<?php echo floor($photo['id'] / 5000); ?>/<?php echo $photo['id']; ?>.jpg" alt="<?php echo $photo['description']; ?>" />
	</a>
    </li>
    <?php endforeach; ?>
</ul>
<div style="clear: both"></div>
<?php else: ?>
<h5>Inget nytt här inte!</h5>
<?php endif; ?>

<div class="beat-footer"></div>