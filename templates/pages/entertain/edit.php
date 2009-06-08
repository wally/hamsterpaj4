<h1>Redigerar entertain-objekt #<?php echo $item->get('id'); ?>, <?php echo $item->get('handle'); ?></h1>

<form method="post" class="entertain_edit">
	<input type="hidden" name="action" value="update" />
	
	<label for="entertain_edit_title">Namn</label>
	<input type="text" name="title" id="etnertain_edit_title" value="<?php echo $item->get('title'); ?>" />
	
	<label>Kategori</label>
	<select name="category">
		<?php foreach(entertain::categories() AS $category) : ?>
			<option value="<?php echo $category['handle']; ?>"><?php echo $category['label']; ?></option>
		<?php endforeach; ?>
	</select>
	
	<h2>Bild</h2>
	
	<h2>Data</h2>
	<?php echo template($item->get('data_edit_template'), array('item' => $item)); ?>

	<h2>Aktivering</h2>
	<ul>
		<li>
			<input type="radio" name="active" value="true" id="entertain_edit_active_true" />
			<label for="entertain_edit_active_true">Aktivt</label>
		</li>
		<li>
			<input type="radio" name="active" value="schedule" id="entertain_edit_active_schedule" />
			<label for="entertain_edit_active_schedule">Schemalagt</label>
			<input type="text" name="release" value="<?php echo date('Y-m-d H:i', $item->get('release')); ?>" />
		</li>
		<li>
			<input type="radio" name="active" value="false" id="entertain_edit_active_false" />
			<label for="entertain_edit_active_false">Ej aktivt (borttaget)</label>
		</li>
	</ul>
	
	
	<input type="submit" value="Uppdatera" />
</form>
