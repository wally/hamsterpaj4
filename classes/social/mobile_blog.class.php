<?php

	class mobile_blog extends hp4
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
								ORDER BY ' . $options['order-by'] . ' ' . $options['order-direction'] . ' 
								LIMIT ' . $options['limit'];

			$mobile_blogs = array();
			foreach($_PDO->query($query) as $entry)
			{
				$mobile_blog = new mobile_blog;
				$mobile_blog->set($entry);
				$mobile_blog->user = user::fetch(array('id' => $entry['user_id']));
				$mobile_blogs[] = $mobile_blog;
			}

			return $mobile_blogs;			
		}
		
		function add()
		{
			global $_PDO;
			
			$query = 'INSERT INTO mobile_blog_posts SET user_id = "' . $this->user->id . '", text = "' . $this->text . '", type = "' . $this->type . '", timestamp = UNIX_TIMESTAMP()';
			$_PDO->query($query);
			tools::debug($query);
		}
		
	}

?>