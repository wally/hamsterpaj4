<script type="text/javascript">
    <!--
    $(function () {
        $('#tags').tagSuggest({
            tags: <?=json_encode($tags)?>
        });
    });
    //-->
</script>

<div>
	<label for="tags">Master-taggar (du måste välja minst en)</label>
	<span class="mastertags">
		<?php foreach($mastertags as $key => $mastertag): ?>
		<label <?php echo in_array($mastertag, $active_mastertags) ? 'class="active"' : 'class="inactive"'; ?> for="mastertags_<?php echo $key; ?>"><?php echo $mastertag; ?></label>
		<input type="checkbox" <?php echo in_array($mastertag, $active_mastertags) ? 'checked="checked"' : ''; ?> name="mastertags[<?php echo $key; ?>]" id="mastertags_<?php echo $key; ?>" value="<?php echo $mastertag; ?>" />
		<?php endforeach; ?>
	</span>

	<label for="tags">Övriga taggar</label>
<input type="text" name="subtags" value="<?php foreach($active_subtags as $tag): echo $tag ?>,<?php endforeach; ?>" id="tags" />
	<br />(Separeras med komma (tag,tag 2))
</div>