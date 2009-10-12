<?php
	//error_reporting(E_ALL);
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
	
	$new_post = tools::array_map_multidimensional('htmlspecialchars', $_POST);
	$new_get = tools::array_map_multidimensional('htmlspecialchars', $_GET);
	
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
		
		// Load all package configs
		$files = tools::fetch_files_from_folder(PATH_PACKAGES);
		foreach($files as $file)
		{
			if(substr($file, -9) == '.conf.php')
			{
				require_once PATH_PACKAGES . $file;
			}
		}
		
		// Load all package classes
		$files = tools::fetch_files_from_folder(PATH_PACKAGES);
		foreach($files as $file)
		{
			if(substr($file, -10) == '.class.php')
			{
				require_once PATH_PACKAGES . $file;
			}
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
						event_log::log($class);
					}
				}
			}
		}
	
		$page->pdo = $_PDO;
		$page->user = new user;
		$page->user->from_session($_SESSION);
		$page->load_side_modules();
		$page->load_menu();
		$page->execute($uri);
	
		$page->user->lastaction();

		if(strlen($page->get('title')) == 0)
		{
			$page->title = 'Hamsterpaj - Community - Underhållning - Onlinespel - Forum';
		}
		if(strlen($page->get('description')) == 0)
		{
			$page->description = 'Hamsterpaj.net - Mötesplats på nätet för ungdomar 13-18 år, där man kan spela spel, titta på filmer och diskutera. Hamsterpaj.net - Tillfredsställelse utan sex!';
		}
		if(strlen($page->get('keywords')) == 0)
		{
			$page->keywords = 'hamsterpaj, onlinespel, diskussionsforum, träffa, roliga bilder, filmklipp, animerat, sex & sinne';
		}
		else
		{
			$page->keywords = $page->get('keywords') . ', hamsterpaj, onlinespel, diskussionsforum, träffa, roliga bilder, filmklipp, animerat, sex & sinne';
		}
		if(strlen($page->get('content_type')) > 0 )
		{
			header('Content-type: ' . $page->get('content_type'));
		} 
		if(strlen($page->get('route')) > 0)
		{
			
		}
		elseif(strlen($page->get('redirect')) > 0)
		{
			header('Location: ' . $page->get('redirect'));
		}
		elseif($page->get('raw_output') === true)
		{
			echo $page->content;
		}
		else
		{
			if( isset($page->template) )
			{
				$out = template(NULL, $page->template, array('page' => $page));
			}
			else
			{
				$out = template(NULL, 'layouts/amanda/layout.php', array('page' => $page));
			}
			 $_SESSION = $page->user->to_session();
			$debug = template(NULL, 'framework/debug.php');
			if(ENVIRONMENT == 'production')
			{
				echo $out;
			}
			else
			{
				echo str_replace('<body>', '<body>' . "\n" . $debug, $out);	
			}
		}
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
?>