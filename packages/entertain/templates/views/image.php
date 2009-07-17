<div class="entertain_div">
	<h1><?php echo $item->get('title'); ?></h1>
		<div class="rating">
			<h2>Rösta här:</h2>
			<input name="star2" type="radio" class="star" title="Värdelös"/>
			<input name="star2" type="radio" class="star" title="Okej"/>
			<input name="star2" type="radio" class="star" checked="checked" title="Bra"/>
			<input name="star2" type="radio" class="star" title="Väldigt bra"/>
			<input name="star2" type="radio" class="star" title="Bäst"/>
		</div>
	<img src="http://static.hamsterpaj.net/entertain/images/<?php echo $item->get('handle'); ?>.jpg" style="width: 638px;" /> 
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