<form action="/soek" class="livesearch" id="searchform">
	<input type="text" id="searchfield" class="searchquery" value="<?php echo isset($searchquery) ? $searchquery : 'Sök underhållning...'; ?>" name="searchquery" autocomplete="off" />
	<input type="submit" value="Sök" />
	<div class="suggestions">
		<?php 
			if(isset($result))
			{
				echo template('livesearch', 'result.php', array('categories' => $result));	
			}
		?>
	</div>
</form>