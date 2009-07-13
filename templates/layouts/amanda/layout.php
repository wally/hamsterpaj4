<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $title; ?></title>
		<link rel="shortcut icon" href="http://images.hamsterpaj.net/favicon.png" type="image/x-icon" />
		<style type="text/css">
				@import url('/style.css');
		</style>
		<script src="/scripts.js" type="text/javascript"></script>
		<script type="text/javascript" src="http://nyheter24.se/template/1-0-1/javascript/ads.js?20090605"></script>
		<script type="text/javascript">Ads.init('http://ads.nyheter24.se/', false);</script>
	</head>
	<body>
		<a href="http://www.hamsterpaj.net/diskussionsforum/hamsterpaj/kodnamn_daniella/sida_1.php#post_1875820"><img src="http://static.hamsterpaj.net/images/layouts/amanda/daniella.png" id="daniella" /></a>
		<div id="wrapper">
			<script type='text/javascript'><!--//<![CDATA[
				Ads.insert(250, 'banner980x120 noprint');
				//]]>-->
			</script>
			<div id="hp">
				<div id="head">
				<a href="/"><h1>Hamsterpaj.net</h1></a>
					<?php if($page->user->exists()) : ?>
						<?php echo template('user', 'noticebar.php', array('user' => $page->user)); ?>
						<?php echo template('user', 'statusbar.php', array('user' => $page->user)); ?>
					<?php else : ?>
						<?php echo template('user', 'loginbar.php'); ?>
					<?php endif; ?>
				</div>
				<?php echo $page->menu->render($page); ?>
				<div id="xxl">
					<?php echo $page->xxl; ?>
				</div>
				<div id="content">
					<?php echo $page->content; ?>
				</div>
				<div id="modules">
					<?php foreach($page->side_modules AS $module) : ?>
						<div class="module" <?php echo isset($module->id) ? ' id="side_module_' . $module->id . '"' : '' ?>>
							<?php echo $module->execute($page); ?>
						</div>
					<?php endforeach; ?>
				</div>
			
				<!-- Google Analytics -->
				<script type="text/javascript">
					var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
					document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
					</script>
					<script type="text/javascript">
					try {
						var pageTracker = _gat._getTracker("UA-7987100-1");
						pageTracker._trackPageview();
					}
					catch(err) {}
				</script>
			</div>
			<div id="column_ads">
			<script type='text/javascript'><!--//<![CDATA[
				Ads.insert(251, '');
				//]]>-->
			</script>
			<script type='text/javascript'><!--//<![CDATA[
				Ads.insert(252, '');
				//]]>-->
			</script>
			
				<script type="text/javascript"><!--
				google_ad_client = "pub-3110640362329253";
				/* hamsterpaj 160x600, skapad 2009-06-08 */
				google_ad_slot = "0695149486";
				google_ad_width = 160;
				google_ad_height = 600;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>
			</div>

		</div>
		<img src="http://sifomedia.nyheter24.se/RealMedia/ads/adstream_nx.ads/nyheter24/123645@TopRight?XE&Sajt=hamsterpaj&Grupp1=nyheter24natverket&XE" border="0" alt="" />
	</body>
</html>
