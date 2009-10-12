<?php
	require_once PATH_ROOT . 'secrets/mobile_blog_config.php';
	
	class MobileBlog extends HP4
	{
		function fetch($options)
		{
			global $_PDO;

			// Set default in-data
			$options['limit'] = isset($options['limit']) ? $options['limit'] : MOBILE_BLOG_DEFAULT_LIMIT;
			$options['order-by'] = isset($options['order-by']) ? $options['order-by'] : MOBILE_BLOG_DEFAULT_ORDER_BY;
			$options['order-direction'] = in_array($options['order-direction'], array('ASC', 'DESC')) ? $options['order-direction'] : MOBILE_BLOG_DEFAULT_ORDER_DIRECTION;

			$query = 'SELECT user_id, text, type, id, timestamp 
				    FROM mobile_blog_posts 
				    WHERE 1 = 1
				    ' . (isset($options['user_id']) ? ' AND user_id = ' . $options['user_id'] : '') . ' 
				    ORDER BY ' . $options['order-by'] . ' ' . $options['order-direction'] . ' 
				    LIMIT ' . $options['limit'];

			$mobile_blogs = array();
			foreach($_PDO->query($query) as $entry)
			{
				$mobile_blog = new MobileBlog;
				$mobile_blog->set($entry);
				$mobile_blog->user = User::fetch(array('id' => $entry['user_id']));
				$mobile_blogs[] = $mobile_blog;
			}

			return $mobile_blogs;
		}

		function add()
		{
			global $_PDO;
			
			$query = 'INSERT INTO mobile_blog_posts SET user_id = "' . $this->user->id . '", text = "' . $this->text . '", type = "' . $this->type . '", timestamp = UNIX_TIMESTAMP()';
			$_PDO->query($query);
			Tools::debug($query);
		}
		
		function remove()
		{
			global $_PDO;
			
			$query = 'UPDATE mobile_blog_posts SET is_removed = 1 WHERE id = :id LIMIT 1';
			$stmt = $_PDO->prepare($query);
			$stmt = bindValue(':id', $this->id);
			$stmt->execute();
		}
		
		function get_control_number($username)
		{
			return substr(hash('sha256', $username . MOBILE_BLOG_CONTROL_NUMBER_HASH), 0, 4);
		}
		
	}

?>