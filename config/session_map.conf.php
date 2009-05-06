<?php
	$session_map['ip'] = array('ip');

	$session_map['created'] = array('login', 'regtimestamp');
	$session_map['id'] = array('login', 'id');

	$session_map['last_action'] = array('login', 'lastaction');
	$session_map['last_ip'] = array('login', 'lastip');
	$session_map['last_logon'] = array('login', 'lastlogon');
	$session_map['last_username_change'] = array('login', 'lastusernamechange');
	$session_map['password_hash'] = array('login', 'password');
	$session_map['reg_ip'] = array('login', 'regip');
	$session_map['session_id'] = array('login', 'session_id');
	$session_map['username'] = array('login', 'username');

	$session_map['birthday'] = array('userinfo', 'birthday');
	$session_map['signature'] = array('userinfo', 'signature');
?>
