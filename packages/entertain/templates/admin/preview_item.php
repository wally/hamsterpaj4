<h1>Förhandsgranskar objektet <?php echo $item->title; ?></h1>
<h2>Så här kommer det uppladdade objektet se ut</h2>
<?php echo $item->render(); ?>

<h2>Så här kommer den lilla reklamrutan för objektet se ut</h2>
<?php echo Entertain::previews(array($item)); ?>
<br style="clear: both;" />

<h2>Så här kommer den stora reklamrutan för objektet se ut</h2>
<?php echo $item->preview_full(); ?>
<br style="clear: both;" />


<input type="button" value="Tillbaka till redigering" onclick="document.location.href='<?php echo $item->get_edit_url(); ?>'";" />