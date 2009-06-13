<?php
	class guestbook
	{
		public function fetch($search, $params)
		{
			global $_PDO;
			if(isset($search['recipient']))
			{
				$search['recipient'] = (is_array($search['recipient'])) ? $search['recipient'] : array($search['recipient']);
			}
			
			$query = 'SELECT * FROM traffa_guestbooks AS g WHERE 1';
			$query .= (count($search['recipient']) > 0) ? ' AND g.recipient IN(:recipient)' : null;
			$query .= ($search['force_unread'] == true) ? ' AND g.read = 0' : null;
			$query .= ($search['allow_private'] == true) ? null : ' AND is_private = 0';
			$query .= ' LIMIT ' . GB_DEFAULT_LIMIT;
			
			$stmt = $_PDO->prepare($query);
			(count($search['recipient']) > 0) ? $stmt->bindValue(':recipient', implode('", "', $search['recipient'])) : null;
			$stmt->execute();
						
			$entries = array();
			while($row = $stmt->fetch())
			{
				$entry = new guestbook();
				$entries[] = $entry;
			}
			return $entries;
		}
		
	}
?>
