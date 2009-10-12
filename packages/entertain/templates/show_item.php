<div class="entertain_item">
	<?php echo $item->render(); ?>
</div>

<?php if(isset($admin)): ?>
	<?php echo $admin; ?>
<?php endif; ?>

<?php echo Entertain::previews_small($matching_tag_items2); ?>

<div class="entertain_comments">
	<?php echo $comment_list->render(); ?>
</div>

<div class="entertain_related">
	<?php echo Entertain::previews($related); ?>
</div>

<?php echo $big_related->preview_full(); ?>