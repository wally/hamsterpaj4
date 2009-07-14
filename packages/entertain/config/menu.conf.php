<?php
	// Main menu object (Menu items in orange
	$menu['onlinespel'] = array('label' => 'Spel', 'priority' => '100', 'url' => '/onlinespel', 'type' => 'big');
	$menu['onlinespel_topplista'] = array('parent' => 'onlinespel', 'label' => 'Topplista', 'url' => '/onlinespel/topplista');
	
	$menu['animerat'] = array('label' => 'Animerat', 'priority' => '100', 'url' => '/animerat', 'type' => 'big');
	$menu['animerat_topplista'] = array('parent' => 'animerat', 'label' => 'Topplista', 'url' => '/onlinespel/topplista');
	
	$menu['filmklipp'] = array('label' => 'Filmklipp', 'priority' => '100', 'url' => '/filmklipp', 'type' => 'big');
	$menu['filmklipp_topplista'] = array('parent' => 'filmklipp', 'label' => 'Topplista', 'url' => '/onlinespel/topplista');
	
	$menu['under_mattan'] = array('label' => 'Under mattan', 'priority' => '70', 'url' => '/under_mattan', 'type' => 'small');
	
	$menu['musik'] = array('parent' => 'under_mattan', 'label' => 'Musik', 'url' => '/musik');
	$menu['filer'] = array('parent' => 'under_mattan', 'label' => 'Filer', 'url' => '/filer');
	$menu['ascii'] = array('parent' => 'under_mattan', 'label' => 'Ascii', 'url' => '/ascii');
	$menu['roliga_bilder'] = array('parent' => 'under_mattan', 'label' => 'Roliga bilder', 'url' => '/roliga_bilder');
	
	$menu['entertain_admin'] = array('label' => 'Entertain', 'url' => '/entertain/ny');
	$menu['entertain_admin_ny'] = array('parent' => 'entertain_admin', 'label' => 'Ladda upp', 'url' => '/entertain/ny');
	$menu['entertain_admin_aktivera'] = array('parent' => 'entertain_admin', 'label' => 'Uppladdat av användare', 'url' => '/entertain/aktivera');
?>