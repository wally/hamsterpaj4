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

	$session_map['DEPRECATED_userlevel'] = array('login', 'userlevel');

	$session_map['birthday'] = array('userinfo', 'birthday');
	$session_map['signature'] = array('userinfo', 'signature');
	$session_map['contact1'] = array('userinfo', 'contact1');
	$session_map['contact2'] = array('userinfo', 'contact2');
	$session_map['gender'] = array('userinfo', 'gender');
	$session_map['image'] = array('userinfo', 'image');
	$session_map['zip_code'] = array('userinfo', 'zip_code');
	$session_map['location'] = array('userinfo', 'geo_location');

	$session_map['location'] = array('userinfo', 'geo_location');

	$session_map['privilegies'] = array('privilegies');
	
	$session_map['groups'] = array('groups_members');
?>
