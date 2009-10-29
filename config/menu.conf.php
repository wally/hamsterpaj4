<?php

// Old hamsterpaj menu
$menu['hamsterpaj'] = array('label' => 'Hamsterpaj', 'priority' => '150', 'url' => '/');
$menu['hamsterpaj_nyheter'] = array('parent' => 'hamsterpaj', 'label' => 'Hamsternytt', 'url' => '/hamsterpaj/hamsterblogg.php');
$menu['hamsterpaj_om_hamsterpaj'] = array('parent' => 'hamsterpaj', 'label' => 'Om Hamsterpaj', 'url' => '/hamsterpaj/about.php');
$menu['hamsterpaj_annonsera'] = array('parent' => 'hamsterpaj', 'label' => 'Annonsera', 'url' => '/hamsterpaj/annonsera.php');
$menu['hamsterpaj_crew'] = array('parent' => 'hamsterpaj', 'label' => 'Vi som gör Hamsterpaj', 'url' => '/hamsterpaj/crew.php');
$menu['hamsterpaj_forslag'] = array('parent' => 'hamsterpaj', 'label' => 'Förslag och buggrapporter', 'url' => '/hamsterpaj/suggestions.php');
$menu['hamsterpaj_regler'] = array('parent' => 'hamsterpaj', 'label' => 'Regler', 'url' => '/hamsterpaj/rules_and_policies.php');
$menu['hamsterpaj_tillbakablickar'] = array('parent' => 'hamsterpaj', 'label' => 'Gamla versioner', 'url' => '/hamsterpaj/tillbakablickar.php');

// Old diskussionsforum menu
$menu['forum'] = array('label' => 'Forum', 'priority' => '120', 'url' => '/diskussionsforum/');
$menu['forum_kategorier'] = array('parent' => 'forum', 'label' => 'Kategorier', 'url' => '/diskussionsforum/', 'priority' => 100);
$menu['forum_dina_notiser'] = array('parent' => 'forum', 'label' => 'Dina forumnotiser', 'url' => '/diskussionsforum/notiser.php', 'checklogin' => true);
$menu['forum_dina_tradar'] = array('parent' => 'forum', 'label' => 'Trådar som du skapat', 'url' => '/diskussionsforum/dina_traadar.php', 'checklogin' => true);
$menu['forum_nya_tradar'] = array('parent' => 'forum', 'label' => 'Nya trådar i forumet', 'url' => '/diskussionsforum/nya_traadar.php');
$menu['forum_sok'] = array('parent' => 'forum', 'label' => 'Sök i forumet', 'url' => '/diskussionsforum/soek.php');

// Old sex och sinne menu
$menu['sex_och_sinne'] = array('label' => 'Sex & Sinne', 'priority' => '115', 'url' => '/sex_och_sinne/');
$menu['sex_och_sinne_start'] = array('parent' => 'sex_och_sinne', 'label' => 'Start', 'url' => '/sex_och_sinne/', 'priority' => 100);
$menu['sex_och_sinne_senaste_fragorna'] = array('parent' => 'sex_och_sinne', 'label' => 'Senaste frågorna', 'url' => '/sex_och_sinne/senaste_fraagorna.html');
$menu['sex_och_sinne_kategorier'] = array('parent' => 'sex_och_sinne', 'label' => 'Kategorier', 'url' => '/sex_och_sinne/kategorier.html');
$menu['sex_och_sinne_sok'] = array('parent' => 'sex_och_sinne', 'label' => 'Sök frågor och svar', 'url' => '/sex_och_sinne/soek.php');
$menu['sex_och_sinne_sexperterna'] = array('parent' => 'sex_och_sinne', 'label' => 'Sexperterna', 'url' => '/sex_och_sinne/sexperterna.php');
$menu['sex_och_sinne_fraga'] = array('parent' => 'sex_och_sinne', 'label' => 'Ställ en fråga', 'url' => '/sex_och_sinne/ny_fraaga.html');
$menu['sex_och_sinne_admin'] = array('parent' => 'sex_och_sinne', 'label' => 'Besvara frågor (admin)', 'url' => '/sex_och_sinne/admin.php', 'privileges' => array('sex_sense_admin'));

// Old träffa menu
$menu['community'] = array('label' => 'Community', 'priority' => '111', 'url' => '/traffa/');
$menu['community_start'] = array('parent' => 'community', 'label' => 'Start', 'url' => '/traffa/', 'priority' => '105');
$menu['community_sok'] = array('parent' => 'community', 'label' => 'Sök medlemmar', 'url' => '/traffa/search.php');
$menu['community_klotterplanket'] = array('parent' => 'community', 'label' => 'Klotterplanket', 'url' => '/traffa/klotterplanket.php');
$menu['community_galleriet'] = array('parent' => 'community', 'label' => 'Galleriet', 'url' => '/traffa/gallery.php');
$menu['community_grupper'] = array('parent' => 'community', 'label' => 'Grupper', 'url' => '/traffa/groups.php', 'checklogin' => true);
$menu['community_gissa_aldern'] = array('parent' => 'community', 'label' => 'Gissa Åldern', 'url' => '/traffa/age_guess.php');
$menu['community_nya_foton'] = array('parent' => 'community', 'label' => 'Nya foton', 'url' => '/traffa/new_photos.php');
$menu['community_chatt'] = array('parent' => 'community', 'label' => 'Chatten', 'url' => '/chat/');

// Old under mattan menu
$menu['under_mattan'] = array('label' => 'Under mattan', 'priority' => '114', 'url' => '/mattan/');
$menu['under_mattan_start'] = array('parent' => 'under_mattan', 'label' => 'Start', 'url' => '/mattan', 'priority' => '108');
$menu['under_mattan_ascii_art'] = array('parent' => 'under_mattan', 'label' => 'Ascii art', 'url' => '/mattan/ascii_art.php');
$menu['under_mattan_falskt_personnummer'] = array('parent' => 'under_mattan', 'label' => 'Falskt personnummer', 'url' => '/mattan/falskt_personnummer.php');
$menu['under_mattan_korkort'] = array('parent' => 'under_mattan', 'label' => 'Körkortsfrågor', 'url' => '/mattan/koerkort.php');
$menu['under_mattan_program'] = array('parent' => 'under_mattan', 'label' => 'Gratis program', 'url' => '/mattan/ladda_ner_program.php');

// Old settings menu
$menu['settings'] = array('label' => 'Inställningar', 'priority' => '111', 'url' => '/installningar/generalsettings.php', 'checklogin' => true);
$menu['settings_general'] = array('parent' => 'settings', 'priority' => '100', 'label' => 'Generella inställningar', 'url' => '/installningar/generalsettings.php', 'checklogin' => true);
$menu['settings_change_username'] = array('parent' => 'settings', 'priority' => '90', 'label' => 'Byt användarnamn', 'url' => '/installningar/changename.php', 'checklogin' => true);
$menu['settings_profile_settings'] = array('parent' => 'settings', 'priority' => '80', 'label' => 'Profilinställningar', 'url' => '/installningar/profilesettings.php', 'checklogin' => true);
$menu['settings_forum_settings'] = array('parent' => 'settings', 'priority' => '70', 'label' => 'Foruminställningar', 'url' => '/installningar/forum_settings.php', 'checklogin' => true);
$menu['settings_avatar_settings'] = array('parent' => 'settings', 'priority' => '60', 'label' => 'Byt visningsbild', 'url' => '/installningar/avatar-settings.php', 'checklogin' => true);
$menu['settings_userblock'] = array('parent' => 'settings', 'priority' => '50', 'label' => 'Blockera användare', 'url' => '/installningar/userblock.php', 'checklogin' => true);
$menu['settings_unregister'] = array('parent' => 'settings', 'label' => 'Avregistrera', 'url' => '/installningar/unregister.php', 'checklogin' => true);


// Old admin menu
$menu['admin'] = array('label' => 'A', 'priority' => '110', 'url' => '/admin/moderator_contact_info.php', 'privileges' => array('ip_ban_admin','warnings_admin','use_ghosting_tools','ip_ban_admin','ov_admin','privilegies_admin'));
$menu['admin_ip_ban'] = array('parent' => 'admin', 'label' => 'IP bann', 'priority' => '109', 'url' => '/admin/ip_ban_admin.php', 'privileges' => array('ip_ban_admin'));
$menu['admin_warnings'] = array('parent' => 'admin', 'label' => 'Varningar', 'url' => '/admin/warnings.php', 'privileges' => array('warnings_admin'));
$menu['admin_guestbook_hack'] = array('parent' => 'admin', 'label' => 'Gästbokshack', 'url' => '/admin/guestbook_hack.php', 'privileges' => array('use_ghosting_tools'));
$menu['admin_user_logins'] = array('parent' => 'admin', 'label' => 'Användar inloggningar', 'url' => '/admin/user_logins.php', 'privileges' => array('ip_ban_admin'));
$menu['admin_ov_statistics'] = array('parent' => 'admin', 'label' => 'OV statistik', 'url' => '/admin/ov_watch.php', 'privileges' => array('ov_admin'));
$menu['admin_admin_log'] = array('parent' => 'admin', 'label' => 'Administrativ logg', 'url' => '/admin/log_view.php', 'privileges' => array('ov_admin'));
$menu['admin_priveleges'] = array('parent' => 'admin', 'label' => 'Privilegier', 'url' => '/admin/privilegies_admin.php', 'privileges' => array('privilegies_admin'));
$menu['admin_contact_info'] = array('parent' => 'admin', 'label' => 'OV kontaktinfo', 'url' => '/admin/moderator_contact_info.php', 'privileges' => array('warnings_admin'));

// Old site admin menu
$menu['site_admin'] = array('label' => 'S', 'priority' => '109', 'url' => '/site_admin/event_log.php', 'privileges' => array('fp_modules_rearrange','use_statistic_tools','discussion_forum_category_admin','use_debug_tools'));
$menu['site_admin_frontpage'] = array('parent' => 'site_admin', 'label' => 'Ordna startsidan', 'url' => '/site_admin/fp_module_list.php', 'privileges' => array('fp_modules_rearrange'));
$menu['site_admin_statistics'] = array('parent' => 'site_admin', 'label' => 'Statistik', 'url' => '/site_admin/event_log.php', 'privileges' => array('use_statistic_tools'));
$menu['site_admin_forum_admin'] = array('parent' => 'site_admin', 'label' => 'Forum admin', 'url' => '/site_admin/discussion_forum_admin.php', 'privileges' => array('discussion_forum_category_admin'));
$menu['site_admin_handy'] = array('parent' => 'site_admin', 'label' => 'Handy', 'url' => '/site_admin/handy.php', 'privileges' => array('use_debug_tools'));
$menu['site_admin_view_session'] = array('parent' => 'site_admin', 'label' => 'Sessionsdata', 'url' => '/site_admin/view_session.php', 'privileges' => array('use_debug_tools'));

?>