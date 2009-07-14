<?php
	// Main menu object (Menu items in orange
	$menu['onlinespel'] = array('label' => 'Spel', 'priority' => '100', 'url' => '/onlinespel', 'type' => 'big');
	$menu['animerat'] = array('label' => 'Animerat', 'priority' => '100', 'url' => '/animerat', 'type' => 'big');
	$menu['filmklipp'] = array('label' => 'Filmklipp', 'priority' => '100', 'url' => '/filmklipp', 'type' => 'big');
	
	// Sub menu choices (Menu items in grey)
	$menu['onlinespel']['sub']['start'] = array('label' => 'Startsidan', 'url' => '/');
	
	$menu['under_mattan']['sub']['musik'] = array('label' => 'Musik', 'url' => '/musik');
	$menu['under_mattan']['sub']['filer'] = array('label' => 'Filer', 'url' => '/filer');
	$menu['under_mattan']['sub']['ascii'] = array('label' => 'Ascii', 'url' => '/ascii');
	$menu['under_mattan']['sub']['roliga_bilder'] = array('label' => 'Roliga bilder', 'url' => '/roliga_bilder');
?>