<?php $data = $item->get('data'); ?>
<?php tools::debug($item); ?>
<div class="entertain_view entertain_div" id="entertain_video">
	<h1><?php echo $item->get('title'); ?></h1>
	<div class="rating">
		<h2>Rösta här:</h2>
		<input name="star2" type="radio" class="star" title="Värdelös"/>
		<input name="star2" type="radio" class="star" title="Okej"/>
		<input name="star2" type="radio" class="star" checked="checked" title="Bra"/>
		<input name="star2" type="radio" class="star" title="Väldigt bra"/>
		<input name="star2" type="radio" class="star" title="Bäst"/>
	</div>
	<div id="flvplayer">This div is replaced by the javascript using swfobject</div>
	<script type="text/javascript">
		var so = new SWFObject("http://nettuts.s3.amazonaws.com/274_flashVideo/Source/mpw_player.swf", "swfplayer", "638", "432", "9", "#000000"); // Player loading
		so.addVariable("flv", "<?php echo 'http://static.hamsterpaj.net/entertain/video/' . $item->handle . '.flv'; ?>"); // File Name
		so.addVariable("jpg", "<?php echo $data['preview']; ?>"); // File Name
		so.addVariable("backcolor","333333"); // Background color of controls in html color code  
		so.addVariable("frontcolor","ffffff"); // Foreground color of controls in html color code  
		so.addParam("allowFullScreen","true"); // Allow fullscreen, disable with false
		so.write("flvplayer"); // This needs to be the name of the div id
	</script>
		<div class="info">
		<div class="extrainfo">
			<dl>
				<dt>Visningar:</dt>
					<dd><?php echo $item->get('views'); ?></dd>
			</dl>
		</div>
		<div class="clear"></div>
		<div class="tags">
			<h4>Taggar: </h4>
			<ul>
				<li><a href="/">Tenacious D</a></li>
				<li><a href="/">Musikvideor</a></li>
				<li><a href="/">Animerat</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<input type="button" id="fullscreen_button" value="Visa i fullskärm" />
	<div class="clear"></div>
</div>
