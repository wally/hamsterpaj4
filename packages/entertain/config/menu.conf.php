<?php
	// Main menu object (Menu items in orange
	$menu['onlinespel'] = array('label' => 'Spel', 'priority' => '100', 'url' => '/onlinespel', 'type' => 'big');
	$menu['animerat'] = array('label' => 'Animerat', 'priority' => '100', 'url' => '/animerat', 'type' => 'big');
	$menu['filmklipp'] = array('label' => 'Filmklipp', 'priority' => '100', 'url' => '/filmklipp', 'type' => 'big');
	
	$menu['underhallning'] = array('label' => 'Filmklipp', 'priority' => '100', 'url' => '/filmklipp', 'type' => 'big');
	
	$menu['musik'] = array('parent' => 'underhallning', 'label' => 'Musik', 'url' => '/musik');
	$menu['filer'] = array('label' => 'Filer', 'url' => '/filer');
	$menu['ascii'] = array('label' => 'Ascii', 'url' => '/ascii');
	$menu['roliga_bilder'] = array('label' => 'Roliga bilder', 'url' => '/roliga_bilder');
?>