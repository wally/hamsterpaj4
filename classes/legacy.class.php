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
		
		$return = array(
		    'cache' => array(
			'unread_group_notices' => 0,
			'group_notices' => array()
		    )
		);
		
		$query = 'SELECT groupid FROM groups_members WHERE userid = ? AND approved = 1';
		$query = $_PDO->prepare($query);
		$query->execute(array($user->get('id')));
		
		$groups_members = array();
		foreach ( $query->fetchAll() as $row )
		{
		    $groups_members[] = $row['groupid'];
		}
		
		$return['groups_members'] = $groups_members;
		
		if ( ! count($groups_members) )
		{
			return $return;
		}
		
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
	
	public static function fetch_forum_notices(User $user)
	{
		if ( ! $user->exists() )
			return false;
		
		global $_PDO;
		
		// The $return-array can be merged into $_SESSION['forum']
		$return = array(
		    'categories' => array(),
		    'new_notices' => 0,
		    'subscriptions' => array()
		);
		
		$query = 'SELECT cv.*, pf.title, pf.handle, pf.parent FROM forum_category_visits as cv
		
		    LEFT JOIN public_forums AS pf ON pf.id = cv.category_id
		    
		    WHERE cv.user_id = ' . $user->get('id') . '
		';
		
		$statement = $_PDO->prepare($query);
		$statement->execute();
		
		$return['categories'] = array();
		
		foreach ( $statement->fetchAll(PDO::FETCH_ASSOC) as $row )
		{
		    $return['categories'][$row['category_id']] = $row;
		}
		
		$return['new_notices'] = 0;
		
		$query = 'SELECT p.*, l.username, l.lastaction, l.userlevel, l.regtimestamp, u.last_warning,
			    u.gender, u.user_status, u.forum_userlabel, u.forum_posts AS author_post_count,
			    u.forum_spam AS author_spam_count, u.birthday, u.image AS author_image, z.spot,
			    pf.quality_level, pf.create_thread, pf.create_post, pf.read_threads,
			    rp.posts AS read_posts, rp.has_voted, child_count - rp.posts AS unread_posts
			
			FROM forum_posts AS p
			
			LEFT OUTER JOIN
			    forum_read_posts AS rp ON
				p.id = rp.thread_id AND rp.user_id = "' . $user->get('id') . '",
			    
			    login AS l,
			    userinfo AS u,
			    zip_codes AS z,
			    public_forums AS pf
			
			WHERE l.id = p.author AND u.userid = l.id AND z.zip_code = u.zip_code
			    AND pf.id = p.forum_id AND rp.subscribing = "true"
			
			ORDER BY unread_posts DESC LIMIT 0, 30';
		
		$result = $_PDO->prepare($query);
		$result->execute();
		
		$threads = array();
		foreach ( $result->fetchAll(PDO::FETCH_ASSOC) as $thread )
		{
		    $threads[] = $thread;
		}
		
		/* The fetch function gives us a lot of unused info, such as post content
		 Make sure to save only relevant info */
		$info_to_store = array('id', 'read_posts', 'has_voted', 'url', 'handle', 'title', 'score', 'child_count', 'username', 'author', 'unread_posts', 'forum_id');
		foreach ($threads as $thread)
		{
			$thread['url'] = '/diskussionsforum/gaa_till_post.php?post_id=' . $thread['last_post'];
			foreach ($info_to_store as $key)
			{
				$return['subscriptions'][$thread['id']][$key] = $thread[$key];
			}
			
			$return['new_notices'] += $thread['unread_posts'];
		}
		
		// Reload notices
		$return['notices'] = array();
    
		$query = 'SELECT n.post_id, n.type, p.author, p.timestamp, l.username, t.handle, t.title, t.forum_id, t.id AS thread_id';
		$query .= ' FROM forum_notices AS n, login AS l, forum_posts AS p, forum_posts AS t';
		$query .= ' WHERE n.user = "' . $user->get('id') . '" AND l.id = p.author AND p.id = n.post_id AND t.id = p.parent_post ORDER BY p.id DESC';
    
		$result = $_PDO->prepare($query);
		$result->execute();
		
		foreach ( $result->fetchAll(PDO::FETCH_ASSOC) as $row )
		{
			$row['title'] = (strlen(trim($row['title'])) == 0) ? 'Rubrik saknas' : $row['title'];
			$return['notices'][] = $row;
		}
		
		$return['new_notices'] += count($return['notices']);
		
		// Reload category subscriptions
		
		$categories = array();	
		foreach ( $return['categories'] as $forum )
		{
		    if ( $forum['subscribing'] )
		    {
			$categories[] = $forum['category_id'];
		    }
		}
		
		$return['new_threads_count'] = 0;
		$return['category_subscriptions'] = array();
		
		$query = 'SELECT id, thread_count FROM public_forums WHERE id IN ("' . implode('", "', $categories) . '")';
		$query .= ' AND userlevel_read <= ' . ($user->exists() ? /*$user->get('userlevel')*/0 : 0);
		
		$result = $_PDO->prepare($query);
		$result->execute();
		
		foreach( $result->fetchAll(PDO::FETCH_ASSOC) as $data)
		{
			if ( $data['thread_count'] > $return['categories'][$data['id']]['last_thread_count'] )
			{
				$category = $return['categories'][$data['id']];
				$category['new_threads'] = $data['thread_count'] - $return['categories'][$data['id']]['last_thread_count'];
				$return['category_subscriptions'][] = $category;
				$return['new_threads_count'] += $category['new_threads'];
			}
		}
		
		$return['new_notices'] += $return['new_threads_count'];
		
		return $return;
	}
	
	public static function fetch_unread_photo_comments(User $user)
	{
		global $_PDO;
		
	    	$query = 'SELECT id, unread_comments, description FROM user_photos WHERE user = :user_id AND unread_comments > 0';
		
		$stmt = $_PDO->prepare($query);
		$stmt->bindValue(':user_id', $user->get('id'), PDO::PARAM_INT);
		$stmt->execute();
		
		$unread = array();
		foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $row )
		{
			$unread[$row['id']] = $row;
		}
		
		return $unread;
	}
	
	public static function discussion_forum_categories_fetch($options)
	{
		global $_PDO;
		
		$options['url_prefix'] = (isset($options['url_prefix'])) ? $options['url_prefix'] : '/diskussionsforum/';
		if(isset($options['id']) && !is_array($options['id']))
		{
			$options['id'] = array($options['id']);
		}
		
		$query = 'SELECT pf.*, t.title AS last_thread_title, t.handle AS last_thread_handle, l.username AS last_thread_username, l.id AS last_thread_author';
		$query .= ' FROM public_forums AS pf, forum_posts AS t, login AS l WHERE 1';
		$query .= (isset($options['parent'])) ? ' AND pf.parent = "' . $options['parent'] . '"' : '';
		$query .= (isset($options['forum_id'])) ? ' AND pf.id = "' . $options['forum_id'] . '"' : ''; // This exists, I know. But it didn't work, so I made my own
		$query .= (isset($options['id'])) ? ' AND pf.id IN("' . implode('", "', $options['id']) . '")' : '';
		$query .= (isset($options['handle'])) ? ' AND pf.handle LIKE "' . $options['handle'] . '"' : '';
		$query .= ' AND t.id = pf.last_thread';
		$query .= ' AND l.id = t.author';
		$query .= ' ORDER BY pf.priority DESC, pf.handle ASC';
		
		$statement = $_PDO->query($query);
		
		$data_rows = array();
		foreach ( $statement->fetchAll(PDO::FETCH_ASSOC) as $data)
		{
			$data_rows[] = $data;
		}
		
		$categories = array();
		
		foreach($data_rows as $data)
		{
			if(!isset($options['max_levels']) || $options['max_levels'] > 0)
			{
				$recursive_options = $options;
				$recursive_options['parent'] = $data['id'];
				if(isset($options['max_levels']))
				{
					$recursive_options['max_levels'] = $options['max_levels'] - 1;
				}
				$recursive_options['url_prefix'] = $options['url_prefix'] . $data['handle'] . '/';
				$children = Legacy::discussion_forum_categories_fetch($recursive_options);
			}
			if(count($children) > 0)
			{
				$data['children'] = $children;
			}
			$data['url'] = $options['url_prefix'] . $data['handle'] . '/';
			
			$categories[] = $data;
		}
		
		return $categories;
	}
}
