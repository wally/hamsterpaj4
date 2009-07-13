<h1><?php echo $item->get('title'); ?></h1>
<div id="flvplayer">This div is replaced by the javascript using swfobject</div>
<script type="text/javascript">
	var so = new SWFObject("http://nettuts.s3.amazonaws.com/274_flashVideo/Source/mpw_player.swf", "swfplayer", "638", "500", "9", "#000000"); // Player loading
	so.addVariable("flv", "<?php echo $data['file']; ?>"); // File Name
	so.addVariable("jpg", "<?php echo $data['preview']; ?>"); // File Name
	so.addParam("allowFullScreen","true"); // Allow fullscreen, disable with false
	so.write("flvplayer"); // This needs to be the name of the div id
</script>