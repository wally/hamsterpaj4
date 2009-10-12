<div class="entertain_preview_full" style="background: url(<?php echo $item->preview_image('full'); ?>);">
	<h2><?php echo $item->get('title'); ?></h2>
	<div class="mp3_player">
		<div id="mp3player">Du måste ha javascript aktiverat för att kunna lyssna på låten</div>
		<script type="text/javascript">
			var so = new SWFObject("http://nettuts.s3.amazonaws.com/274_flashVideo/Source/mpw_player.swf", "swfplayer", "500", "27", "7", "#000000"); // Player loading
			so.addVariable("mp3", "<?php echo 'http://static.hamsterpaj.net/entertain/mp3/' . $item->get('handle') . '.mp3'; ?>"); // File Name
			so.addParam("allowFullScreen","false"); // Allow fullscreen, disable with false
			so.write("mp3player"); // This needs to be the name of the div id
		</script>
		<div class="info">
			<dl>
				<dt>Filstorlek:</dt>
					<dd><?php echo Tools::file_size_readable($data['size']); ?></dd>
					
				<dt><a href="<?php echo 'http://static.hamsterpaj.net/entertain/mp3/' . $item->get('handle') . '.mp3'; ?>">Ladda ner</a></dt>
					<dd></dd>
			</dl>
		</div>
	</div>	
</div> 