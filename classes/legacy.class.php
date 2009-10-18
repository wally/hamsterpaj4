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
	    global $_PDO;
	    
	    $query = 'SELECT id FROM groups_members WHERE userid = ?';
	    $query = $_PDO->prepare($query);
	    $query->execute(array($user->get('id')));
	    
	    $groups_members = array();
	    foreach ( $query->fetchAll() as $row )
	    {
		$groups_members[] = $row['id'];
	    }
	    
	    $return['groups_members'] = $groups_members;
	    
	    $query = 'SELECT groups_list.groupid, groups_list.message_count, groups_members.read_msg, groups_list.name FROM groups_members, groups_list ';
	    $query .= 'WHERE groups_members.groupid IN(' . implode(', ', $return['groups_members']) . ') AND groups_list.groupid = groups_members.groupid';
	    $query .= ' AND groups_members.userid =' . $user->get('id') . ' AND groups_members.notices = "Y"';
	    
	    $return = array();
	    foreach ( $_PDO->query($query) as $row )
	    {
		    $message_count = $row['message_count'] - $row['read_msg'];
		    $return['unread_group_notices'] += $message_count;
		    $return['group_notices'][$row['groupid']] = array('unread_messages' => $message_count, 'title' => $row['name'], 'groupid' => $row['groupid']);
	    }
	    
	    return $return;
    }
}
