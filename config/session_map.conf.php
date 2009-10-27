<?php
	$session_map['ip'] = array('ip');

	$session_map['created'] = array('login', 'regtimestamp');
	$session_map['id'] = array('login', 'id');
	$session_map['last_action'] = array('login', 'lastaction');
	$session_map['last_ip'] = array('login', 'lastip');
	$session_map['last_logon'] = array('login', 'lastlogon');
	$session_map['last_username_change'] = array('login', 'lastusernamechange');
	$session_map['reg_ip'] = array('login', 'regip');
	$session_map['session_id'] = array('login', 'session_id');
	$session_map['username'] = array('login', 'username');
	$session_map['password'] = array('login', 'password');
	$session_map['quality_level'] = array('login', 'quality_level');
	$session_map['quality_level_expire'] = array('login', 'quality_level_expire');

	$session_map['DEPRECATED_userlevel'] = array('login', 'userlevel');

	$session_map['birthday'] = array('userinfo', 'birthday');
	$session_map['signature'] = array('userinfo', 'user_status');
	$session_map['contact1'] = array('userinfo', 'contact1');
	$session_map['contact2'] = array('userinfo', 'contact2');
	$session_map['gender'] = array('userinfo', 'gender');
	$session_map['image'] = array('userinfo', 'image');
	$session_map['image_ban_expire'] = array('userinfo', 'image_ban_expire');
	$session_map['zip_code'] = array('userinfo', 'zip_code');
	$session_map['location'] = array('userinfo', 'geo_location');
	$session_map['x_rt90'] = array('userinfo', 'x_rt90');
	$session_map['y_rt90'] = array('userinfo', 'y_rt90');
	$session_map['firstname'] = array('userinfo', 'firstname');
	$session_map['surname'] = array('userinfo', 'surname');
	$session_map['email'] = array('userinfo', 'email');

	$session_map['privileges'] = array('privilegies');
	
	$session_map['groups'] = array('groups_members');
	
	$session_map['preferences'] = array('preferences');
	$session_map['photoblog_preferences'] = array('photoblog_preferences');
	
	$session_map['module_states'] = array('preferences', 'module_states');
	$session_map['module_order'] = array('preferences', 'module_order');
	
	$session_map['cache'] = array('cache');
	$session_map['last_update'] = array('cache', 'lastupdate');
	
	$session_map['notices'] = array('notices');
	$session_map['notifications'] = array('notifications');
	
	$session_map['visitors_with_image'] = array('visitors_with_image');
	
	$session_map['unread_photo_comments'] = array('cache', 'unread_photo_comments');
	
	$session_map['forum'] = array('forum');
?>