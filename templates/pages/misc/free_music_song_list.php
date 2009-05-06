<dl class="free_music_songs">
	<?php foreach($songs AS $song) : ?>
		<dt><?php echo $song['title']; ?></dt>
			<dd>
				<div class="player" id="<?php echo md5($song['url']); ?>">
					<a href="http://www.macromedia.com/go/getflashplayer">Installera Flash Player</a> för att kunna se den här grejen.
				</div>	
				<script type="text/javascript">
					var s1 = new SWFObject("http://www.hamsterpaj.net/entertain/flvplayer.swf","single","350","20","7");
					s1.addParam("allowfullscreen","true");
					s1.addVariable("file","<?php echo $song['url']; ?>");
					s1.addVariable("width","350");
					s1.addVariable("height","20");
					s1.write("<?php echo md5($song['url']); ?>");
				</script>
				<a href="<?php echo $song['url']; ?>"><button>Ladda ner MP3</button></a>
		</dd>
	<?php endforeach; ?>
</dl>