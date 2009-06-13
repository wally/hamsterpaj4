<?php
	class group extends hp4
	{
		function exists()
		{
			return ($this->id > 0) ? true : false;
		}
		
		function fetch($search, $options)
		{
			global $_PDO;
			
			$query = 'SELECT l.groupid, l.owner, l.take_new_members, l.name, l.description, l.presentation, l.not_member_read_presentation';
			$query .= ', l.not_member_read_messages, l.message_count, l.disabled, l.group_points, l.check_time, l.autojoin';
			$query .= ', m.userid, m.approved, m.own_group';
			
			$query .= ' FROM groups_list AS l LEFT OUTER JOIN groups_members AS m ON m.groupid = l.groupid';
			$query .= ' WHERE 1';
			$query .= (isset($search['id'])) ? ' AND l.groupid = :groupid' : null;
			$query .= ' LIMIT 10';
			
			$stmt = $_PDO->prepare($query);
			(isset($search['id'])) ? $stmt->bindValue(':groupid', $search['id']) : null;
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$group = new group();
				$group->set(array('id' => $row['groupid']));
				$group->set(array('name' => $row['name']));
				$group->set(array('description' => $row['description']));
				$group->set(array('message_count' => $row['message_count']));
				
				$members[$row['groupid']][] = $row['userid'];
				$groups[$row['groupid']] = $group;
			}
			
			
			foreach($groups AS $group)
			{
				$users = user::fetch(array('id' => $members[$group->get('id')]), array('allow_multiple' => true));
				$groups[$group->get('id')]->set(array('members' => $users));
			}
			
			return ($options['allow_multiple'] == true) ? $groups : array_pop($groups);
		}
		
		function join($user)
		{
			global $_PDO;
			$query = 'SELECT COUNT(*) AS is_member FROM groups_members WHERE groupid = :groupid AND userid = :userid LIMIT 1';
			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':groupid', $this->id);
			$stmt->bindValue(':userid', $user->get('id'));
			$stmt->execute();
			$data = $stmt->fetch();
			if($data['is_member'] == 0)
			{
				$query = 'INSERT INTO groups_members(groupid, userid, approved, own_group, read_msg, notices) VALUES(';
				$query .= ':groupid, :userid, 1, 0, 0, "Y")';
				$stmt = $_PDO->prepare($query);
				$stmt->bindValue(':groupid', $this->id);
				$stmt->bindValue(':userid', $user->get('id'));
				$stmt->execute();
				
				$this->new_entry(array('author' => $user, 'body' => $user->get('username') . ' har gått med i gruppen!'));
			}
		}
		
		function new_entry($arg)
		{
			global $_PDO;
			$query = 'INSERT INTO groups_scribble (userid, groupid, timestamp, text, deleted)';
			$query .= ' VALUES(:userid, "' . $this->get('id') . '", "' . time() . '", "' . $arg['body'] . '", 0)';

			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':userid', $arg['author']->get('id'));
			$stmt->bindValue(':groupid', $this->get('id'));
			$stmt->bindValue(':timestamp', time());
			$stmt->bindValue(':text', $arg['body']);
			$stmt->execute();
			
			$this->message_count++;
			$this->save();
		}
		
		function entries($options)
		{
			global $_PDO;
			$options['offset'] = 0;
			$options['limit'] = 25;
			
			$query .= 'SELECT id, userid, timestamp, text, deleted FROM groups_scribble WHERE groupid = :groupid';
			$query .= ' ORDER BY id DESC LIMIT :offset, :limit';
			
			$stmt = $_PDO->prepare($query);
			$stmt->bindValue(':groupid', $this->id);
			$stmt->bindValue('offset', $options['offset']);
			$stmt->bindValue('limit', $options['limit']);
			$stmt->execute();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$entry = new group_entry();
				$entry->set(array('text' => $row['text'], 'id' => $row['id'], 'timestamp' => $row['timestamp']));
				
				$author = user::fetch(array('id' => $row['userid']));
				$entry->set(array('author' => $author));
				
				$entries[] = $entry;
			}
			
			return $entries;
		}
		
		function save()
		{
			if($this->id > 0)
			{
				
			}
			else
			{
				$query = 'INSERT INTO ';
			}
		}
	}
	
	class group_entry extends hp4
	{
		
	}
?>