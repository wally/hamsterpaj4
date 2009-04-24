<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $title; ?></title>
		<link rel="shortcut icon" href="http://images.hamsterpaj.net/favicon.png" type="image/x-icon" />
		<style type="text/css">
			@import url('/css/framework.css');
		</style>
	</head> 
	<body>
		<div id="wrapper">
			<div id="hp">
				<div id="head">
					<h1><a href="/">Hamsterpaj.net</a></h1>
					<?php if($page->user->exists()) : ?>
						<?php echo template('framework/noticebar.php', $page->user); ?>
						<?php echo template('framework/statusbar.php', $page->user); ?>
					<?php else : ?>
						<?php echo template('framework/loginbar.php'); ?>
					<?php endif; ?>
				</div>
				<div id="main_menu">
					<?php echo template('framework/main_menu.php', $page); ?>
					<img src="http://images.hamsterpaj.net/steve/empty.gif" id="steve" />
				</div>
				<div id="modules">
					<?php foreach($page->side_modules AS $module) : ?>
						<div class="module">
							<?php echo $module->execute(); ?>
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
