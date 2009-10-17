<?php

// Old hamsterpaj menu
$menu['hamsterpaj'] = array('label' => 'Hamsterpaj', 'priority' => '150', 'url' => '/');
$menu['hamsterpaj_nyheter'] = array('parent' => 'hamsterpaj', 'label' => 'Nyheter', 'url' => '/hamsterpaj/nytt.php');
$menu['hamsterpaj_om_hamsterpaj'] = array('parent' => 'hamsterpaj', 'label' => 'Om Hamsterpaj', 'url' => '/hamsterpaj/about.php');
$menu['hamsterpaj_annonsera'] = array('parent' => 'hamsterpaj', 'label' => 'Annonsera på Hamsterpaj', 'url' => '/hamsterpaj/annonsera.php');
$menu['hamsterpaj_crew'] = array('parent' => 'hamsterpaj', 'label' => 'Vi som gör Hamsterpaj', 'url' => '/hamsterpaj/crew.php');
$menu['hamsterpaj_forslag'] = array('parent' => 'hamsterpaj', 'label' => 'Förslag och buggrapporter', 'url' => '/hamsterpaj/suggestions.php');
$menu['hamsterpaj_regler'] = array('parent' => 'hamsterpaj', 'label' => 'Regler på Hamsterpaj', 'url' => '/hamsterpaj/rules_and_policies.php');
$menu['hamsterpaj_tillbakablickar'] = array('parent' => 'hamsterpaj', 'label' => 'Gamla versioner av Hamsterpaj', 'url' => '/hamsterpaj/tillbakablickar.php');

// Old diskussionsforum menu
$menu['forum'] = array('label' => 'Forum', 'priority' => '120', 'url' => '/diskussionsforum/');
$menu['forum_kategorier'] = array('parent' => 'forum', 'label' => 'Kategorier', 'url' => '/diskussionsforum/', 'priority' => 100);
$menu['forum_dina_notiser'] = array('parent' => 'forum', 'label' => 'Dina forumnotiser', 'url' => '/diskussionsforum/notiser.php');
$menu['forum_dina_tradar'] = array('parent' => 'forum', 'label' => 'Trådar som du skapat', 'url' => '/diskussionsforum/dina_traadar.php');
$menu['forum_nya_tradar'] = array('parent' => 'forum', 'label' => 'Nya trådar i forumet', 'url' => '/diskussionsforum/nya_traadar.php');
$menu['forum_sok'] = array('parent' => 'forum', 'label' => 'Sök i forumet', 'url' => '/diskussionsforum/soek.php');

// Old sex och sinne menu
$menu['sex_and_sense'] = array('label' => 'Sex & Sinne', 'priority' => '100', 'url' => '/sex_och_sinne/');

// Old träffa menu
$menu['traffa'] = array('label' => 'Träffa', 'priority' => '90', 'url' => '/traffa/');

//
?>