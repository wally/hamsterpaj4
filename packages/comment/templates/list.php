<?php if ( isset($comments) && count($comments) ): ?>
<ul class="comment_list" id="comment_list&<?php echo $item_id . '-' . $type; ?>">
	<?php foreach($comments as $comment): ?>
		<?php echo $comment->render($user); ?>
	<?php endforeach; ?>
</ul>
<?php endif; ?>