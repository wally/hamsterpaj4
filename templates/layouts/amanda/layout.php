<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title><?php echo $page->get('title'); ?></title>
		
		<link rel="shortcut icon" href="http://images.hamsterpaj.net/favicon.png" type="image/x-icon" />
		
		<meta name="title" content="<?php echo $page->get('title'); ?>" />
		<meta name="description" content="<?php echo $page->get('description'); ?>" />
		<meta name="keywords" content="<?php echo strtolower($page->get('keywords')); ?>" />
		
		<link rel="image_src" href="http://images.hamsterpaj.net/fp_recent_update_thumb_universal.png" />
		
		<style type="text/css">
			@import url('/style.css');
			<?php if ( IS_HP3_REQUEST ): ?>
			@import url('/old_style.css:<?php echo implode(',', $page->extra_css); ?>');
			<?php endif; ?>
		</style>
		
		<!-- HP JavaScript -->
		<script src="/scripts.js" type="text/javascript"></script>
		
		<?php foreach ( Tools::pick($page->extra_js, array()) as $script ): ?>
		    <script type="text/javascript" src="http://iphone2.hamsterpaj.net/javascripts/<?php echo $script; ?>"></script>
		<?php endforeach; ?>
		
		<!-- Ad JavaScript -->
		<script type="text/javascript" src="http://nyheter24.se/template/1-0-1/javascript/ads.js?20090605"></script>
		<script type="text/javascript">Ads.init('http://ads.nyheter24.se/', false);</script>
	</head>
	<body>
		<!-- Kiaindex -->
		<img src="http://sifomedia.nyheter24.se/RealMedia/ads/adstream_nx.ads/nyheter24/123645@TopRight?XE&Sajt=hamsterpaj&Grupp1=nyheter24natverket&XE" border="0" alt="" />
		
		<!-- Adtoma crap -->
		<script type="text/javascript">
			var CM8Server = "ad.adtoma.com";
			var CM8Cat = "hp.start";
			var CM8Profile = "hp_age=&hp_birthyear=&hp_gender=xx"
		</script>
		
		<script type="text/javascript" src="http://ad.adtoma.com/adam/cm8adam_1_call.js"></script>
		
		<!-- Adwell crap -->
		<script type="text/javascript">
			var uri = 'http://anet.tradedoubler.com/anet?type(js)loc(55632)' + new
			String (Math.random()).substring (2, 11);
			document.write('<sc'+'ript type="text/javascript" src="'+uri+'"'
			+ 'charset="UTF-8"></sc'+'ript>');
		</script>

		<a href="http://www.hamsterpaj.net/diskussionsforum/hamsterpaj/kodnamn_daniella/sida_1.php#post_1875820"><img alt="Kodnamn: Daniella" src="http://static.hamsterpaj.net/images/layouts/amanda/daniella.png" id="daniella" /></a>
		<div id="wrapper">
			<script type='text/javascript'><!--//<![CDATA[
				Ads.insert(250, 'banner980x120 noprint');
				//]]>-->
			</script>
			<div id="hp">
				<div id="head">
				<h2><a href="/">Hamsterpaj.net</a></h2>
					<?php if( $page->user->exists() ) : ?>
						<?php echo template('user', 'noticebar.php', array('user' => $page->user)); ?>
						<?php echo template('user', 'statusbar.php', array('user' => $page->user)); ?>
					<?php else : ?>
						<?php echo template('user', 'loginbar.php'); ?>
					<?php endif; ?>
				</div>
				<?php echo $page->menu->render($page); ?>
				<div id="xxl">
					<?php echo isset($page->xxl) ? $page->xxl : ''; ?>
				</div>
				<div id="content">
					<?php foreach ( $page->user->fetch_notifications() as $note ): ?>
					    <?php echo call_user_func_array('template', $note); ?>
					<?php endforeach; ?>
					
					<script type="text/javascript">CM8ShowAd("635x50");</script>
					<?php echo $page->content; ?>
				</div>
				<div id="modules">
					<?php foreach($page->side_modules AS $module) : ?>
						<div class="module" <?php echo isset($module->id) ? ' id="side_module_' . $module->id . '"' : '' ?>>
							<?php echo $module->execute($page); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div id="column_ads">
				<script type="text/javascript">CM8ShowAd("Skyscraper");</script>
				<script type='text/javascript'><!--//<![CDATA[
					Ads.insert(251, '');
					//]]>-->
				</script>
				<script type='text/javascript'><!--//<![CDATA[
					Ads.insert(252, '');
					//]]>-->
				</script>
			
				<!-- Adwell crap -->
				<script type="text/javascript">
					var uri = 'http://anet.tradedoubler.com/anet?type(js)loc(55633)' + new
					String (Math.random()).substring (2, 11);
					document.write('<sc'+'ript type="text/javascript" src="'+uri+'" charset="UTF-8"></sc'+'ript>');
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
		
		<!-- Clickheat -->
		<?php if(isset($page->clickheat)): ?>
		<script type="text/javascript" src="http://www.hamsterpaj.net/clickheat/js/clickheat.js"></script>
		<noscript><p><a href="http://www.labsmedia.com/index.html">Traffic monetization</a></p></noscript>
		<script type="text/javascript"><!--
			clickHeatSite = 'hamsterpaj';
			clickHeatGroup = '<?php echo $page->clickheat; ?>';
			clickHeatQuota = 3;
			clickHeatServer = 'http://www.hamsterpaj.net/clickheat/click.php';
			initClickHeat(); //-->
		</script>
		<?php endif; ?>
		<!-- End Clickheat Tag -->
		
		<!-- Google Analytics -->
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-10835550-1");
		pageTracker._trackPageview();
		} catch(err) {}</script>
		
	</body>
</html>
