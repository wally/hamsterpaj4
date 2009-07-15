<h1 class="entertain_head">Redigerar entertain-objekt #<?php echo $item->get('id'); ?>, <?php echo $item->get('handle'); ?></h1>

<form method="post" class="entertain_edit" enctype="multipart/form-data">
	<input type="hidden" name="action" value="update" />
	
	<div id="object_name">
		<label for="entertain_edit_title">Namn</label>
		<input type="text" name="title" id="etnertain_edit_title" value="<?php echo $item->get('title'); ?>" />
	</div>
	
	<div id="object_type">
		<label>Kategori</label>
		<?php echo $dropdown->render(); ?>
	</div>
	
	<label>Typ av objekt</label>
	<?php echo $item->get('type'); ?>

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
	
	<?php $check_0 = ($item->get('has_image')) ? null : ' checked="true"'; ?>
	<?php $check_1 = ($item->get('has_image')) ? ' checked="true"' : null; ?>
	<input type="radio" name="has_image" value="0" id="entertain_admin_has_image_0"<?php echo $check_0; ?> />
	<label for="entertain_admin_has_image_0">Standard-bild</label>
	<input type="radio" name="has_image" value="1" id="entertain_admin_has_image_1"<?php echo $check_1; ?> />
	<label for="entertain_admin_has_image_1">Egen screenshot</label>
	
	<h2>Taggar</h2>
	<?php echo tag::render_form('entertain'); ?>
	
	<h2>Data</h2>
	<?php echo $item->render_edit_form(); ?>
	

	<h2>Aktivering</h2>
	<ul>
		<?php if($privilegies['release']): ?>
		<li>
			<input type="radio" name="status" <?php echo ($item->get('status') == 'released' ? 'checked="checked"' : ''); ?> value="released" id="entertain_edit_status_released" />
			<label for="entertain_edit_status_released">Aktiverad</label>
		</li>
		<?php endif; ?>
		<?php if($privilegies['schedule']): ?>
		<li>
			<input type="radio" name="status" <?php echo ($item->get('status') == 'scheduled' ? 'checked="checked"' : ''); ?> value="scheduled" id="entertain_edit_status_scheduled" />
			<label for="entertain_edit_status_scheduled">Schemalagd</label>
			<input type="text" name="release" value="<?php echo date('Y-m-d H:i', $item->get('release')); ?>" />
		</li>
		<?php endif; ?>
		<li>
			<input type="radio" name="status" <?php echo ($item->get('status') == 'preview' ? 'checked="checked"' : ''); ?> value="preview" id="entertain_edit_status_preview" />
			<label for="entertain_edit_status_preview">Förhandsgranska objektet</label>
		</li>
		<li>
			<input type="radio" name="status" <?php echo ($item->get('status') == 'queue' ? 'checked="checked"' : ''); ?> value="queue" id="entertain_edit_status_queue" />
			<label for="entertain_edit_status_queue">Ställ objektet i kö för validering</label>
		</li>
		<?php if($privilegies['remove']): ?>
		<li>
			<input type="radio" name="status" <?php echo ($item->get('status') == 'removed' ? 'checked="checked"' : ''); ?> value="removed" id="entertain_edit_status_removed" />
			<label for="entertain_edit_status_removed">Borttagen</label>
		</li>
		<?php endif; ?>
	</ul>
	
	
	<input type="submit" value="Spara" />
</form>
