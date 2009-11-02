<?php
	class Guestbook
	{
		public static function fetch($search, $params = array())
		{
			global $_PDO;
			if(isset($search['recipient']))
			{
				$search['recipient'] = (is_array($search['recipient'])) ? $search['recipient'] : array($search['recipient']);
			}
			
			$query = 'SELECT * FROM traffa_guestbooks AS g WHERE 1';
			$query .= (count($search['recipient']) > 0) ? ' AND g.recipient IN(:recipient)' : null;
			$query .= (Tools::is_true($search['force_unread'])) ? ' AND g.read = 0' : null;
			$query .= (Tools::is_true($search['allow_private'])) ? null : ' AND is_private = 0';
			$query .= (Tools::is_true($search['get_removed'])) ? null : ' AND g.deleted = 0';
			$query .= ' LIMIT ' . GB_DEFAULT_LIMIT;
			
			$stmt = $_PDO->prepare($query);
			if (count($search['recipient']) > 0)
			    $stmt->bindValue(':recipient', implode('", "', $search['recipient']));
			$stmt->execute();
						
			$entries = array();
			while($row = $stmt->fetch())
			{
				$entry = new Guestbook();
				$entries[] = $entry;
			}
			return $entries;
		}
		
	}
?>
