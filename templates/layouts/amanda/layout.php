<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $title; ?></title>
		<link rel="shortcut icon" href="http://images.hamsterpaj.net/favicon.png" type="image/x-icon" />
		<style type="text/css">
			@import url('/css/framework.css');
			@import url('/css/side_modules/search.css');
			@import url('/css/side_modules/forum_posts.css');
			@import url('/css/side_modules/profile_visitors.css');
			@import url('/css/misc/alphabet_on_time.css');
		</style>
		<script src="/scripts/jquery-1.3.2.min.js" type="text/javascript"></script>
		<script src="/scripts/misc/alphabet_on_time.js" type="text/javascript"></script>
		<script src="/scripts/debug.js" type="text/javascript"></script>
	</head> 
	<body>
		<a href="http://www.hamsterpaj.net/diskussionsforum/hamsterpaj/kodnamn_daniella/sida_1.php#post_1875820"><img src="http://static.hamsterpaj.net/images/layouts/amanda/daniella.png" id="daniella" /></a>
		<div id="wrapper">
			<div id="hp">
				<div id="head">
				<a href="/"><h1>Hamsterpaj.net</h1></a>
					<?php if($page->user->exists()) : ?>
						<?php echo template('layouts/amanda/noticebar.php', array('user' => $page->user)); ?>
						<?php echo template('layouts/amanda/statusbar.php', array('user' => $page->user)); ?>
					<?php else : ?>
						<?php echo template('layouts/amanda/loginbar.php'); ?>
					<?php endif; ?>
				</div>
				<?php echo template('layouts/amanda/main_menu.php', array('page' => $page)); ?>
				<div id="modules">
					<?php foreach($page->side_modules AS $module) : ?>
						<div class="module" <?php echo isset($module->id) ? ' id="side_module_' . $module->id . '"' : '' ?>>
							<?php echo $module->execute($page); ?>
						</div>
					<?php endforeach; ?>
				</div>
				<div id="content">
					<?php echo $page->content; ?>
				</div>

				<!-- Nielsen Netratings -->
				<script type="text/javascript">
					var _rsCI="hamsterpaj-se";	 /* client ID */
					var _rsCG="0";	 /* content group */
					var _rsDN="//secure-dk.imrworldwide.com/";	 /* data node */
				</script>
				<script type="text/javascript" src="//secure-dk.imrworldwide.com/v52.js"></script>
				<noscript>
					<img src="//secure-dk.imrworldwide.com/cgi-bin/m?ci=hamsterpaj-se&amp;cg=0&amp;cc=1" alt=""/>
				</noscript>
			
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
		</div>
	</body>
</html>
