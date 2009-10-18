<?php

/*
    Class:
	Legacy
    
    This class contains static methods for fetching group notices, etc, that are
    linked to the old system, not in Daniella. Therefor this class should slowly
    fade away when the everything is moved into packages in Daniella.
*/

class Legacy
{
    public static function fetch_group_notices(User $user)
    {
	    if ( ! $user->exists() )
		return false;
	    
	    global $_PDO;
	    $return = array('cache' => array('unread_group_notices' => 0));
	    
	    $query = 'SELECT groupid FROM groups_members WHERE userid = ? AND approved = 1';
	    $query = $_PDO->prepare($query);
	    $query->execute(array($user->get('id')));
	    
	    $groups_members = array();
	    foreach ( $query->fetchAll() as $row )
	    {
		$groups_members[] = $row['groupid'];
	    }
	    
	    $return['groups_members'] = $groups_members;
	    
	    $query = 'SELECT groups_list.groupid, groups_list.message_count, groups_members.read_msg, groups_list.name FROM groups_members, groups_list ';
	    $query .= 'WHERE groups_members.groupid IN(' . implode(', ', $return['groups_members']) . ') AND groups_list.groupid = groups_members.groupid';
	    $query .= ' AND groups_members.userid =' . $user->get('id') . ' AND groups_members.notices = "Y"';
	    
	    $result = $_PDO->prepare($query);
	    $result->execute();
	    
	    foreach ( $result->fetchAll() as $row )
	    {
		    $message_count = $row['message_count'] - $row['read_msg'];
		    $return['cache']['unread_group_notices'] += $message_count;
		    $return['cache']['group_notices'][$row['groupid']] = array('unread_messages' => $message_count, 'title' => $row['name'], 'groupid' => $row['groupid']);
	    }
	    
	    return $return;
    }
}
