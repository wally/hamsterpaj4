<?php
	// Main menu object (Menu items in orange
	$menu['onlinespel'] = array('label' => 'Spel', 'priority' => '100', 'url' => '/onlinespel', 'type' => 'big');
	$menu['animerat'] = array('label' => 'Animerat', 'priority' => '100', 'url' => '/animerat', 'type' => 'big');
	$menu['filmklipp'] = array('label' => 'Filmklipp', 'priority' => '100', 'url' => '/filmklipp', 'type' => 'big');
	$menu['roliga_bilder'] = array('label' => 'Roliga bilder', 'priority' => '90', 'url' => '/roliga_bilder', 'type' => 'small');
	
	// Sub menu choices (Menu items in grey)
	$menu['onlinespel']['sub']['start'] = array('label' => 'Startsidan', 'url' => '/');
?>