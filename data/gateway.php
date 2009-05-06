<?php
	session_start();
	require_once '../classes/framework.class.php'; // is requiered because it is needed when fetching the rest of the classes
	require_once '../classes/tools.class.php'; // is requiered because it is needed when fetching the rest of the classes
	require_once '../classes/user.class.php'; // is requiered because it is needed when fetching the rest of the classes
	require_once '../config/paths.conf.php';// is requiered because it is needed when fetching the classes and configs
	require_once '../secrets/secret.class.php';
	require_once '../secrets/db_config.php';

	try
	{
		// Load all classes
		$classes = tools::fetch_files_from_folder(PATH_CLASSES);
		foreach($classes as $class)
		{
			require_once PATH_CLASSES . $class;
		}
		// Load all configs
		$configs = tools::fetch_files_from_folder(PATH_CONFIGS);
		foreach($configs as $config)
		{
			require_once PATH_CONFIGS . $config;
		}
		
		$dns = DB_ENGINE . ':dbname=' . DB_DATABASE . ';host=' . DB_HOST . ';charset=' . DB_CHARSET;
		$_PDO = new PDO($dns, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));
		$_PDO->query('SET NAMES utf8');
	
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
			$page_handler = 'alphabet_on_time';
		}
		if(substr($uri, 1, 12) == 'gratis-musik')
		{
			$page_handler = 'free_music';
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
		$page->load_side_modules();
		$page->execute();
	
		$out = template('layouts/amanda/layout.php', array('page' => $page));

		$page->user->lastaction();
		$_SESSION = $page->user->to_session();
		$debug = template('framework/debug.php');
		echo str_replace('<body>', '<body>' . "\n" . $debug, $out);	
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
?>
