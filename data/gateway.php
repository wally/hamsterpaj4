<?php
	session_start();
	require_once '../classes/framework.class.php'; // is requiered because it is needed when fetching the rest of the classes
	require_once '../classes/tools.class.php'; // is requiered because it is needed when fetching the rest of the classes
	require_once '../classes/user.class.php'; // is requiered because it is needed when fetching the rest of the classes
	require_once '../config/paths.conf.php';// is requiered because it is needed when fetching the classes and configs
	require_once '../secrets/secret.class.php';
	require_once '../secrets/db_config.php';


	// Sanitize POST and GET data
	$new_post = array();
	$new_get = array();
	
	foreach($_POST AS $key => $value)
	{
		if(!is_array($value))
		{
			$new_post[htmlspecialchars($key)] = htmlspecialchars($value);
		}
	}
	
	foreach($_GET AS $key => $value)
	{
		if(!is_array($value))
		{
			$new_get[htmlspecialchars($key)] = htmlspecialchars($value);
		}
	}
	
	$_OLD_POST = $_POST;
	$_POST = $new_post;
	$_GET = $new_get;
	unset($new_post, $new_get);



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
	
		if($uri == '/digga')
		{
			$page_handler = 'digga_start';
		}
		if($uri == '/digga/ny-digga')
		{
			$page_handler = 'digga_add';
		}
		if(substr($uri, 0, 13) == '/digga/artist')
		{
			$page_handler = 'digga_artist';
		}
		if(substr($uri, 0, 12) == '/digga/graph')
		{
			tools::debug('Found graph!');
			$page_handler = 'digga_graph';
		}
		if(substr($uri, 0, 7) == '/log-in')
		{
			$page_handler = 'login';
		}
		if(substr($uri, 0, 7) == '/logout')
		{
			$page_handler = 'logout';
		}
		if(substr($uri, 0, 12) == '/skattjakten')
		{
			$page_handler = 'treasurehunt';
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
		$page->execute($uri);
	
		$page->user->lastaction();

		if($page->get('raw_output') === true)
		{
			echo $page->content;
		}
		else
		{
			$out = template('layouts/amanda/layout.php', array('page' => $page));
			// If the session is damaged when visiting a Daniella page, please add mapping data in conf/session_map.conf.php
			// ONLY fields present in the session_map-config will be saved to session!
			 $_SESSION = $page->user->to_session();
			$debug = template('framework/debug.php');
			echo str_replace('<body>', '<body>' . "\n" . $debug, $out);	
		}
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
?>