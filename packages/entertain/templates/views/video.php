<?php $data = $item->get('data'); ?>
<?php Tools::debug($item); ?>
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
			var so = new SWFObject("http://developer.longtailvideo.com/player/trunk/as3/player.swf","785Ply","638","400","9","#FFFFFF"); // Player loading
			so.addVariable("jpg", "http://static.hamsterpaj.net/entertain/video/<?php echo $item->handle; ?>.jpg"); // File Name
			so.addParam("allowscriptaccess","always"); 
			<?php if(file_exists('/mnt/static/entertain/video/' . $item->handle . '.mp4')): ?>
				so.addParam("flashvars","file=<?php echo 'http://static.hamsterpaj.net/entertain/video/' . $item->handle . '.flv'; ?>&plugins=hd&hd.file=<?php echo 'http://static.hamsterpaj.net/entertain/video/' . $item->handle . '.mp4'; ?>"); 	
			<?php else: ?>
				so.addParam("flashvars","file=<?php echo 'http://static.hamsterpaj.net/entertain/video/' . $item->handle . '.flv'; ?>"); 	
			<?php endif; ?>
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
		<?php if(count($item->tags) > 0): ?>
		<div class="tags">
			<h4>Taggar: </h4>
			<ul>
				<?php foreach($item->tags as $tag): ?>
					<li><a href="/<?php echo $item->category; ?>/taggar/<?php echo $tag->handle; ?>"><?php echo $tag->title; ?></a></li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	</div>
	<div class="clear"></div>
</div>
