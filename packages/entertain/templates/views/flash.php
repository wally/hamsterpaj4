<?php $data = $item->get('data'); ?>
<?php tools::debug($item); ?>
<div class="entertain_view entertain_div" id="entertain_flash">
	<h1><?php echo $item->get('title'); ?></h1>
	<div class="rating">
		<h2>Rösta här:</h2>
		<input name="star2" type="radio" class="star" title="Värdelös"/>
		<input name="star2" type="radio" class="star" title="Okej"/>
		<input name="star2" type="radio" class="star" checked="checked" title="Bra"/>
		<input name="star2" type="radio" class="star" title="Väldigt bra"/>
		<input name="star2" type="radio" class="star" title="Bäst"/>
	</div>
	<object width="638" height="432px">
		<param name="movie" value="<?php echo $data['flashfile']; ?>">
		<embed src="<?php echo $data['flashfile']; ?>" width="638" height="432px"></embed>
	</object>
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
