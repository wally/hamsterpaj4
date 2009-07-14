<div class="entertain_item">
	<?php echo $item->render(); ?>
</div>

<?php if(isset($admin)): ?>
	<?php echo $admin; ?>
<?php endif; ?>

<div class="entertain_comments">
	<?php echo $comment_list->render(); ?>
</div>

<div class="entertain_related">
	<?php echo entertain::previews($related); ?>
</div>

<?php echo $big_related->preview_full(); ?>

<?php 

/*
// Get size of video
$info_output = shell_exec('/usr/bin/ffmpeg -i /home/patrick/War3-Movie-Trailer.avi 2>&1');
$info = explode(':', $info_output); 
$info[17] = explode(',', $info[17]); 
$info[17][2] = explode('[', $info[17][2]); 
$size = str_replace(' ', '', $info[17][2][0]);
$size = explode('x', $size); 

$width = $size[0];
$height = $size[1];
$aspect_ratio = $width/$height;
$new_width = 314;
$new_height = $aspect_ratio*$height;
*/

?>