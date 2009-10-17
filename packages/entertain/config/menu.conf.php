<?php
	// Main menu object (Menu items in orange
	$menu['onlinespel'] = array('label' => 'Onlinespel', 'priority' => '133', 'url' => '/onlinespel/');
	$menu['onlinespel_crews-favoriter'] = array('parent' => 'onlinespel', 'label' => 'Crews Favoriter', 'url' => '/onlinespel/taggar/crews-favoriter');
	$menu['onlinespel_valgjort'] = array('parent' => 'onlinespel', 'label' => 'Välgjort', 'url' => '/onlinespel/taggar/valgjort');
	$menu['onlinespel_action'] = array('parent' => 'onlinespel', 'label' => 'Action', 'url' => '/onlinespel/taggar/action');
	$menu['onlinespel_skjutspel'] = array('parent' => 'onlinespel', 'label' => 'Skjutspel', 'url' => '/onlinespel/taggar/skjutspel');
	$menu['onlinespel_strategispel'] = array('parent' => 'onlinespel', 'label' => 'Strategispel', 'url' => '/onlinespel/taggar/strategispel');
	$menu['onlinespel_musikspel'] = array('parent' => 'onlinespel', 'label' => 'Musikspel', 'url' => '/onlinespel/taggar/musikspel');
	$menu['onlinespel_plattformsspel'] = array('parent' => 'onlinespel', 'label' => 'Plattformsspel', 'url' => '/onlinespel/taggar/plattformsspel');
	$menu['onlinespel_sportspel'] = array('parent' => 'onlinespel', 'label' => 'Sportspel', 'url' => '/onlinespel/taggar/sportspel');
	$menu['onlinespel_bilspel'] = array('parent' => 'onlinespel', 'label' => 'Bilspel', 'url' => '/onlinespel/taggar/bilspel');
	$menu['onlinespel_nedladdningsbara'] = array('parent' => 'onlinespel', 'label' => 'Nedladdningsbara', 'url' => '/onlinespel/taggar/nedladdningsbara');
	
	$menu['onlinespel_topplista'] = array('parent' => 'onlinespel', 'label' => 'Topplista', 'url' => '/onlinespel/topplista');
	
	
	$menu['animerat'] = array('label' => 'Animerat', 'priority' => '131', 'url' => '/animerat/');
	$menu['animerat_musikvideor'] = array('parent' => 'animerat', 'label' => 'Musikvideor', 'url' => '/animerat/taggar/musikvideor');
	$menu['animerat_valgjort'] = array('parent' => 'animerat', 'label' => 'Välgjort', 'url' => '/animerat/taggar/valgjort');
	
	$menu['animerat_topplista'] = array('parent' => 'animerat', 'label' => 'Topplista', 'url' => 'animerat/topplista');
	
	
	$menu['filmklipp'] = array('label' => 'Filmklipp', 'priority' => '132', 'url' => '/filmklipp/');
	$menu['filmklipp_valgjort'] = array('parent' => 'filmklipp', 'label' => 'Välgjort', 'url' => '/filmklipp/taggar/valgjort');
	$menu['filmklipp_crews-favoriter'] = array('parent' => 'filmklipp', 'label' => 'Musikvideor', 'url' => '/filmklipp/taggar/crews-favoriter');
	$menu['filmklipp_musikvideor'] = array('parent' => 'filmklipp', 'label' => 'Musikvideor', 'url' => '/filmklipp/taggar/musikvideor');
	$menu['filmklipp_olyckor'] = array('parent' => 'filmklipp', 'label' => 'Olyckor', 'url' => '/filmklipp/taggar/olyckor');
	$menu['filmklipp_reklamfilmer'] = array('parent' => 'filmklipp', 'label' => 'Reklamfilmer', 'url' => '/filmklipp/taggar/reklamfilmer');
	$menu['filmklipp_parodier'] = array('parent' => 'filmklipp', 'label' => 'Parodier', 'url' => '/filmklipp/taggar/parodier');

	$menu['filmklipp_topplista'] = array('parent' => 'filmklipp', 'label' => 'Topplista', 'url' => '/filmklipp/topplista');

	$menu['roliga_bilder'] = array('label' => 'Roliga bilder', 'url' => '/roliga_bilder/', 'priority' => '130');
	$menu['roliga_bilder_roliga_katter'] = array('parent' => 'roliga_bilder', 'label' => 'Roliga katter', 'url' => '/roliga_bilder/taggar/roliga-katter');
	$menu['roliga_bilder_roliga_skyltar'] = array('parent' => 'roliga_bilder', 'label' => 'Roliga skyltar', 'url' => '/roliga_bilder/taggar/roliga-skyltar');
	$menu['roliga_bilder_roliga_djur'] = array('parent' => 'roliga_bilder', 'label' => 'Roliga djur', 'url' => '/roliga_bilder/taggar/roliga-djur');
	$menu['roliga_bilder_pedobear'] = array('parent' => 'roliga_bilder', 'label' => 'Pedobear', 'url' => '/roliga_bilder/taggar/Pedobear');
	$menu['roliga_bilder_lopsedlar'] = array('parent' => 'roliga_bilder', 'label' => 'Löpsedlar', 'url' => '/roliga_bilder/taggar/lopsedlar');
?>