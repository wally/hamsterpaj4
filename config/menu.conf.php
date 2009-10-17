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
$menu['discussion_forum'] = array('label' => 'Diskussionsforum', 'priority' => '120', 'url' => '/diskussionsforum/');

// Old sex och sinne menu
$menu['sex_and_sense'] = array('label' => 'Sex & Sinne', 'priority' => '100', 'url' => '/sex_och_sinne/');

// Old träffa menu
$menu['traffa'] = array('label' => 'Träffa', 'priority' => '90', 'url' => '/traffa/');

//
?>