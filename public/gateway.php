<?php
	session_start();
	include('../config/paths.conf.php');
	include('../lib/framework.lib.php');
	include('../lib/user.lib.php');
	include('../lib/classes/page_404.class.php');
	include('../lib/classes/digga.class.php');
	include('../lib/classes/misc/alphabet_on_time.class.php');
	include('../lib/classes/login.class.php');

	include('../lib/tools.class.php');

	include('../lib/side_modules/statistics.class.php');
	include('../lib/side_modules/profile_visitors.class.php');
	include('../lib/side_modules/search.class.php');
	include('../lib/side_modules/forum_posts.class.php');
	include('../secrets/secret.class.php');
	
	if (!$database_settings = parse_ini_file('../database/my_settings.ini', TRUE)) throw new exception('Unable to open ../database/my_settings.ini');
	$dns = $database_settings['engine'] . ':dbname=' . $database_settings['dbname'] . ';host=' . $database_settings['host'] . ';charset=' . $database_settings['charset'];
	$_PDO = new PDO($dns, $database_settings['username'], $database_settings['password'], array(PDO::ATTR_PERSISTENT => true));
	unset($database_settings);

	$uri = $_SERVER['REQUEST_URI'];
	if(strpos($uri, '?'))
	{
		parse_str(substr($uri, strpos($uri, '?')+1), $_GET);
		$uri = substr($uri, 0, strpos($uri, '?'));			
	}

	if(substr($uri, 0, 6) == '/digga')
	{
		$page_handler = 'digga';
	}
	if(substr($uri, 0, 7) == '/log-in')
	{
		$page_handler = 'login';
	}
	if(substr($uri, 0, 7) == '/logout')
	{
		$page_handler = 'logout';
	}
	if(substr($uri, 1, 17) == 'alfabetet-paa-tid')
	{
		debug('Alfabetet efterfrågades');
		$page_handler = 'alphabet_on_time';
	}
	
	$page_class = 'page_' . $page_handler;
	if(class_exists($page_class))
	{
		$page = new $page_class();
	}
	else
	{
		$page = new page_404();
	}

	$page->pdo = $_PDO;
	$page->user = new user;
	$page->user->from_session($_SESSION);
	$page->execute();

	$out = template('framework/layout_standard.php', $page);
	$debug = template('framework/debug.php');
	echo str_replace('<body>', '<body>' . "\n" . $debug, $out);


	$page->user->lastaction();
	$page->user->to_session();
?>
