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
	<label for="tags">Taggar</label>
	<input type="text" name="tags" value="" id="tags" />
</div>