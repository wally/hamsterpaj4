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
$menu['sex_och_sinne'] = array('label' => 'Sex & Sinne', 'priority' => '100', 'url' => '/sex_och_sinne/');
$menu['sex_och_sinne_start'] = array('parent' => 'sex_och_sinne', 'label' => 'Start', 'url' => '/sex_och_sinne/', 'priority' => 100);
$menu['sex_och_sinne_senaste_fragorna'] = array('parent' => 'sex_och_sinne', 'label' => 'Senaste frågorna', 'url' => '/sex_och_sinne/senaste_fraagorna.html');
$menu['sex_och_sinne_kategorier'] = array('parent' => 'sex_och_sinne', 'label' => 'Kategorier', 'url' => '/sex_och_sinne/kategorier.html');
$menu['sex_och_sinne_sok'] = array('parent' => 'sex_och_sinne', 'label' => 'Sök frågor och svar', 'url' => '/sex_och_sinne/soek.php');
$menu['sex_och_sinne_sexperterna'] = array('parent' => 'sex_och_sinne', 'label' => 'Sexperterna', 'url' => '/sex_och_sinne/sexperterna.php');
$menu['sex_och_sinne_fraga'] = array('parent' => 'sex_och_sinne', 'label' => 'Ställ en fråga', 'url' => '/sex_och_sinne/ny_fraaga.html');
$menu['sex_och_sinne_admin'] = array('parent' => 'sex_och_sinne', 'label' => 'Besvara frågor (admin)', 'url' => '/sex_och_sinne/admin.php', 'is_privilegied' => array('sex_sense_admin'));

// Old träffa menu
$menu['traffa'] = array('label' => 'Träffa', 'priority' => '90', 'url' => '/traffa/');

//
?>