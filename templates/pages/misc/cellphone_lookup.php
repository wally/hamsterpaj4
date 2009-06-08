<style type="text/css">@import url("/css/misc/cellphone_lookup.css");</style>
<?php if (!empty($data['operator_alias']) || $data['operator_alias'] === false): ?>
<h2>Numret <strong><?php echo $data['phone_number_readable']; ?></strong> har</h2>
<h1 id="operator_container" class="<?php echo $data['operator_short']; ?><?php echo $data['operator_alias'] === false ? ' no_abonnent' : NULL; ?>"><strong><?php echo $data['operator_alias'] === false ? 'Ingen abonnent' : $data['operator_alias']; ?></strong></h1>
<?php else: ?>
<h1>Mobilnummer</h1>
<?php endif; ?>
<div id="cellphone_lookup_form">
	<form action="" name="cellphone_lookup_form" id="cellphone_lookup_form">
		Mobilnummer: 
		<input type="text" name="cellphone_number" onkeyup="function () { document.cellphone_lookup_form.action = '/mobilnummer/' + this.value; };" id="cellphone_number" />
		<input type="submit" value="Checka!" onclick="document.location = '/mobilnummer/' + document.cellphone_lookup_form.cellphone_number.value; return false;" id="cellphone_submit" />
	</form>
</div>