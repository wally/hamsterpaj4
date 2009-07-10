<?php if(!empty($data['css'])): ?>
	<style type="text/css">
		<?php echo $data['css']; ?>
	</style>	
<?php endif ?>

<?php echo html_entity_decode($data['html']); ?>