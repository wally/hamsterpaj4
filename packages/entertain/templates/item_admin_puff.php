<div class="entertain_item_admin_puff">
	<h1>Var hälsad du privilegerade, du kan leka med objektet här</h1>
	<form method="POST" action="<?php echo $item->get_remove_url(); ?>">
		<input type="hidden" name="action" value="remove" />
		<input type="submit" value="Radera" />
		<input type="button" value="Redigera" onclick="document.location.href='<?php echo $item->get_edit_url() ?>'" />
	</form>
</div>