<?php
	@session_start();
	
	define('IS_HP4', true);
	
	require_once '../classes/framework.class.php';
	require_once '../classes/tools.class.php';
	require_once '../classes/user.class.php';
	require_once '../config/paths.conf.php';
	require_once '../secrets/secret.class.php';
	require_once '../secrets/db_config.php';

	// Sanitize POST and GET data
	$new_post = array();
	$new_get = array();
	
	$new_post = Tools::array_map_multidimensional('htmlspecialchars', $_POST);
	$new_get = Tools::array_map_multidimensional('htmlspecialchars', $_GET);
	
	$_OLD_POST = $_POST;
	$_POST = $new_post;
	$_GET = $new_get;
	unset($new_post, $new_get);

	try
	{
		// Load all classes
		$classes = Tools::fetch_files_from_folder(PATH_CLASSES);
		foreach($classes as $class)
		{
			require_once PATH_CLASSES . $class;
		}
		
		// Load all package configs
		$files = Tools::fetch_files_from_folder(PATH_PACKAGES);
		foreach($files as $file)
		{
			if(substr($file, -9) == '.conf.php')
			{
				require_once PATH_PACKAGES . $file;
			}
		}
		
		// Load all package classes
		$files = Tools::fetch_files_from_folder(PATH_PACKAGES);
		foreach($files as $file)
		{
			if(substr($file, -10) == '.class.php')
			{
				require_once PATH_PACKAGES . $file;
			}
		}
		
		// Load all configs
		$configs = Tools::fetch_files_from_folder(PATH_CONFIGS);
		foreach($configs as $config)
		{
			if (substr($config, -4) == '.php' )
			{
				require_once PATH_CONFIGS . $config;
			}
		}
		
		$report_errors = true;
		
		function hp_error_handler($errno, $errstr, $errfile, $errline)
		{
			global $report_errors;
			
			if ( ! $report_errors )
			{
				return false;
			}
			
			switch ( $errno )
			{
				case E_ERROR: $str = 'Error'; break;
				case E_WARNING: $str = 'Warning'; break;
				case E_NOTICE: $str = 'Notice'; break;
				default: $str = 'PHP Error'; break;
			}
			
			Tools::debug(sprintf('<em><strong>%s</strong> on %s<strong>:%d</strong></em><br />%s', $str, $errfile, $errline, $errstr));
		}
		
		if ( ENVIRONMENT == 'development' )
		{
			error_reporting(E_ALL);
			
			set_error_handler('hp_error_handler');
		}
		
		$dns = DB_ENGINE . ':dbname=' . DB_DATABASE . ';host=' . DB_HOST . ';charset=' . DB_CHARSET;
		$_PDO = new PDO($dns, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));
		$_PDO->query('SET NAMES utf8');
	
		if ( ENVIRONMENT == 'development' )
		{
			$_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
			if(substr($class, 0, 4) == 'Page')
			{
				if(method_exists($class, 'url_hook'))
				{
					$match = call_user_func(array($class, 'url_hook'), $uri);
					if($match > $top_match)
					{
						$page = new $class();
						$page_class = $class;
						$top_match = $match;
						
						EventLog::log($class);
					}
				}
			}
		}
		
		$page->user = new User;
		$page->user->from_session($_SESSION);
		$page->load_side_modules();
		$page->load_menu();
		
		// Check for cached version
		$cache_time = Cache::Exists('pagecache_time_' . $page_class) ? Cache::Exists('pagecache_time_' . $page_class) : false;
		
		// Page should be cached?
		if($cache_time && ENVIRONMENT == 'production')
		{
			// Check for usable cache
			if(Cache::last_update('pagecache_page_' . $page_class) > (time() - $cache_time))
			{
				// Load cache
				$page = Cache::load('pagecache_page_' . $page_class);
			}
			else
			{
				// No usable cache exists. Do cache
				$page->execute($uri);
				Cache::save('pagecache_page_' . $page_class, $page);
			}
		}
		else
		{
			// Just simply load page
			$page->execute($uri);
		}
		
		// If cache time is set on page build cachefile
		if(isset($page->cache))
		{
			Cache::save('pagecache_time_' . $page_class, $page->cache);
		}
		
		// -- start HP3
		if ( $page instanceof Page404 )
		{
			$report_errors = false;
			
			// The directory in which the files lay
			$_dir = '';
			
			$pieces = explode('/', trim($uri, '/'));
			
			// Check if the file is a real file, i.e. not URL rewrited
			if ( strstr($uri, '.php') && file_exists(PATH_HP3 . $uri) )
			{
				// Remove filename from dir
				array_pop($pieces);
				
				$_dir = PATH_HP3 . implode(DIRECTORY_SEPARATOR, $pieces);				
				$_file = PATH_HP3 . $uri;
			}
			elseif ( is_dir(PATH_HP3 . $pieces[0]) )
			{
				$_dir = PATH_HP3 . $pieces[0];
				$_file = $_dir . '/index.php';
			}
			else
			{
				$_dir = false;
			}
			
			if ( $_dir != false )
			{
				define('IS_HP3_REQUEST', true);
				
				$_OLD_SERVER = $_SERVER;
				$_SERVER['PHP_SELF'] = $uri;
				
				// Emulate HP3 environment
				$cwd = getcwd();
				chdir($_dir);
				
				// If HP3 overrides error_reporting directive
				$error_reporting = ini_get('error_reporting');
				
				// Variables that should not be overwritten
				$__page = $page;
				$__menu = $menu;
				
				ob_start();
				include($_file);
				$page_contents = ob_get_clean();
				
				// Reset variables
				$page = $__page;
				$menu = $__menu;
				
				// Set error_reporting to old value
				error_reporting($error_reporting);
				
				// Change back to HP4
				chdir($cwd);
				
				Tools::pick_inplace($ui_options, array());
				Tools::pick_inplace($ui_options['stylesheets'], array());
				Tools::pick_inplace($ui_options['javascripts'], array());
				Tools::pick_inplace($ui_options['menu_active'], NULL);
				Tools::pick_inplace($ui_options['title'], false);
				
				$remove_scripts = array(
					'jquery.js',
					'jquery-ui.js',
					'jquery.dimensions.js',
					'synchronize.js',
					'swfobject.js',
					'ui.js',
					'ui_modules.js',
					'ui_multisearch.js',
					'ui_business_card.js',
					'stay_online.js',
					'md5.js',
					'steve.js'
				);

				foreach ( $remove_scripts as $script )
				{
					while ( false !== ($position = array_search($script, $ui_options['javascripts'])))
					{
						 array_splice($ui_options['javascripts'], $position, 1);
					}
				}

				$page->menu_active = $ui_options['menu_active'];
				$page->extra_css = $ui_options['stylesheets'];
				$page->extra_js = $ui_options['javascripts'];
				$page->title = $ui_options['title'];
				
				if ( ! isset($ui_options['ui_top_called']) )
				{
					$page->raw_output = true;
				}
				
				$page->content = $page_contents;
				
				$_SERVER = $_OLD_SERVER;
			}
			else
			{
				define('IS_HP3_REQUEST', false);
			}
			$report_errors = true;
		}
		else
		{
			define('IS_HP3_REQUEST', false);
		}
		// -- end HP3
	
		$page->user->lastaction();
		$_SESSION = $page->user->to_session();

		if (strlen($page->get('title')) == 0)
		{
			$page->title = 'Hamsterpaj - Community - Underhållning - Onlinespel - Forum';
		}
		if (strlen($page->get('description')) == 0)
		{
			$page->description = 'Hamsterpaj.net - Mötesplats på nätet för ungdomar 13-18 år, där man kan spela spel, titta på filmer och diskutera. Hamsterpaj.net - Tillfredsställelse utan sex!';
		}
		if (strlen($page->get('keywords')) == 0)
		{
			$page->keywords = 'hamsterpaj, onlinespel, diskussionsforum, träffa, roliga bilder, filmklipp, animerat, sex & sinne';
		}
		else
		{
			$page->keywords = $page->get('keywords') . ', hamsterpaj, onlinespel, diskussionsforum, träffa, roliga bilder, filmklipp, animerat, sex & sinne';
		}
		
		if (strlen($page->get('content_type')) > 0 )
		{
			header('Content-type: ' . $page->get('content_type'));
		}
		
		if (strlen($page->get('route')) > 0)
		{
			
		}
		elseif (strlen($page->get('redirect')) > 0)
		{
			header('Location: ' . $page->get('redirect'));
			exit;
		}
		elseif ($page->get('raw_output') === true)
		{
			echo $page->content;
		}
		else
		{
			$template = Tools::pick($page->template, 'layouts/amanda/layout.php');
			$out = template(NULL, $template, array('page' => $page));
			
			if ( ENVIRONMENT == 'production' || ! DEBUG_SHOW )
			{
				echo $out;
			}
			else
			{
				$debug = template(NULL, 'framework/debug.php');
				echo str_replace('<body>', '<body>' . "\n" . $debug, $out);	
			}
		}
	}
	catch (PDOException $e)
	{
		echo '<div style="background: #fff; position: absolute; top: 0px; width: 100%; left: 0px; border: 3px solid red; overflow: auto;">';
		echo '<h1>Oh noes! Error error abort abort! ABORT!</h1>';
		echo '<p>' . $e->getMessage() . '</p>';
		echo Tools::preint_r($e->getTrace());
		echo '</div>';
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
?>