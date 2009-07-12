<?php
	// Main menu object (Menu items in orange
	$menu['games'] = array('label' => 'Spel', 'priority' => '100', 'url' => '/onlinespel', 'type' => 'big');
	$menu['animated'] = array('label' => 'Animerat', 'priority' => '100', 'url' => '/animerat', 'type' => 'big');
	$menu['film'] = array('label' => 'Filmklipp', 'priority' => '100', 'url' => '/filmklipp', 'type' => 'big');
	$menu['roliga_bilder'] = array('label' => 'Roliga bilder', 'priority' => '90', 'url' => '/roliga_bilder', 'type' => 'small');
	
	// Sub menu choices (Menu items in grey)
	$menu['games']['sub']['index'] = array('label' => 'Startsidan', 'url' => '/');
?>