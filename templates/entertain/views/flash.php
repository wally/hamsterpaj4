<div class="entertain_view">
	<h1><?php echo $item->get('title'); ?></h1>
	<!--[if !IE]> -->
	<object type="application/x-shockwave-flash" data="<?php echo $item->get('data'); ?>">
	<!-- <![endif]-->
	
	<!--[if IE]>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0">
	  <param name="movie" value="<?php echo $item->get('url'); ?>" />
	<!--><!--dgx-->
	  <param name="loop" value="true" />
	  <param name="menu" value="false" />
	
	  <p>This is <b>alternative</b> content.</p>
	</object>
	<!-- <![endif]-->
</div>
