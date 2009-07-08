<h1>Redigerar entertain-objekt #<?php echo $item->get('id'); ?>, <?php echo $item->get('handle'); ?></h1>

<form method="post" class="entertain_edit" enctype="multipart/form-data">
	<input type="hidden" name="action" value="update" />
	
	<label for="entertain_edit_title">Namn</label>
	<input type="text" name="title" id="etnertain_edit_title" value="<?php echo $item->get('title'); ?>" />
	
	<label>Kategori</label>
	<?php echo $dropdown->render(); ?>

	<h2>Bild</h2>
	<img src="<?php echo $item->preview_image('medium'); ?>" name="<?php echo $item->get('handle'); ?>" id="entertain_admin_preview_image" />
	<div id="entertain_preview_upload">
		<button id="entertain_edit_preview_upload_submit" name="<?php echo $item->get('handle'); ?>">Ladda upp bild</button>
	</div>
	<div id="entertain_edit_preview_confirm">
		<p>Fungerade det bra att ladda upp bilden?</p>
		<button id="entertain_edit_preview_confirm_success">Ja</button>
		<button id="entertain_edit_preview_confirm_fail">Nej</button>
	</div>
	
	<input type="radio" name="has_image" value="0" id="entertain_admin_has_image_0" />
	<label for="entertain_admin_has_image_0">Standard-bild</label>
	<input type="radio" name="has_image" value="1" id="entertain_admin_has_image_1" />
	<label for="entertain_admin_has_image_1">Egen screenshot</label>
	
	<h2>Data</h2>
	<?php echo $item->render_edit_form(); ?>

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
