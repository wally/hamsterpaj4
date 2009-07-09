<?php
	// Main menu object (Menu items in orange
	$menu['games'] = array('label' => 'Spel', 'priority' => '0', 'url' => '/onlinespel', 'type' => 'big');
	$menu['flash'] = array('label' => 'Flash', 'priority' => '0', 'url' => '/flash', 'type' => 'small');
	$menu['film'] = array('label' => 'Filmklipp', 'priority' => '0', 'url' => '/filmklipp', 'type' => 'big');
	
	// Sub menu choices (Menu items in grey)
	$menu['games']['sub']['index'] = array('label' => 'Startsidan', 'url' => '/');
?>