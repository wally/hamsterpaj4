<?php
	session_start();
	require_once '../classes/framework.class.php';
	require_once '../classes/tools.class.php';
	require_once '../classes/user.class.php';
	require_once '../config/paths.conf.php';
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
		
		try {
			$_PDO = new PDO( DB_ENGINE . ':dbname=' . DB_DATABASE . ';host=' . DB_HOST . ';charset=' . DB_CHARSET, DB_USER, DB_PASS );
			$_PDO -> setAttribute( PDO::ATTR_PERSISTENT, true );
			$_PDO -> setAttribute( PDO::ATTR_CASE, PDO::CASE_LOWER );
			$_PDO -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$_PDO -> setAttribute( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true );
			$_PDO -> setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
			
			$_PDO -> query( 'SET NAMES utf8' );
		} catch ( PDOException $e ){
			exit( '[DBASE]: Error!' );
		}
		
		$uri = $_SERVER['REQUEST_URI'];
		if(strpos($uri, '?'))
		{
			parse_str(substr($uri, strpos($uri, '?')+1), $_GET);
			$uri = substr($uri, 0, strpos($uri, '?'));			
		}
		$uri = (substr($uri, -1) == '/') ? substr($uri, 0, -1) : $uri;
	
		$page = false;
		$classes = get_declared_classes();
		$top_match = 0;
		foreach($classes AS $class)
		{
			if(substr($class, 0, 5) == 'page_')
			{
				if(method_exists($class, 'url_hook'))
				{
					$match = call_user_func(array($class, 'url_hook'), $uri);
					if($match > $top_match)
					{
						$page = new $class();
						$top_match = $match;
					}
				}
			}
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