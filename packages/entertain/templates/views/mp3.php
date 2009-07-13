<div class="entertain_preview_full">
	<h2><?php echo $item->get('title'); ?></h2>
	<div class="mp3_player">

		
		<div id="player1" class="player">
			Player1
		</div>
	
		<script type="text/javascript">
			var s1 = new SWFObject("http://www.hamsterpaj.net/entertain/flvplayer.swf","single","634","80","7");
			s1.addParam("allowfullscreen","true");
			s1.addVariable("file","http://amuse.hamsterpaj.net/distribute/clip/faran_i_att_dela_en_7up.flv");
			s1.addVariable("image","http://images.hamsterpaj.net//entertain/faran_i_att_dela_en_7up.png");
			s1.addVariable("width","634");
			s1.addVariable("height","80");
			s1.write("player1");
		</script>
		
		<dl>
			<dt>Längd</dt>
				<dd>00:14</dd>
				
			<dt>Filstorlek</dt>
				<dd>3.5mb</dd>
		</dl>
	</div>	
</div>