<p id="livesearch_results">
	<?php foreach($categories as $category): ?>

		<h2><?php echo $category[0]['category_name']; ?></h2>
		
		<div class="category">
		<?php foreach($category as $item): ?>
			<a href="<?php echo $item['item_url']; ?>">
				<div class="item">
		    	<span><?php echo $item['item_name']; ?></span>
		    </div>
		  </a>
		<?php endforeach; ?>
	</div>
	<?php endforeach; ?>
	
	<?php if(count($categories) == 0): ?>
		<span class="seperator">
			Ingenting hittades
		</span>
	<?php endif; ?>
</p>