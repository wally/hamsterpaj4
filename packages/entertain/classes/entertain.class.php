<?php
	# This is simply a base entertain class, to be extended by
	# different data types, such as entertain_text and entertain_image
	
	class Entertain extends HP4
	{
		function preview_full()
		{
			return template('entertain', 'preview_full.php', array('item' => $this));
		}
		
		function update_views()
		{
			$this->views++;
			$this->save();
		}
		
		public static function previews($items)
		{
			return template('entertain', 'previews.php', array('items' => $items));
		}
		
		public static function previews_small($items)
		{
			return template('entertain', 'previews_small.php', array('items' => $items));
		}
		
		public static function categories()
		{
			global $_ENTERTAIN;

			return $_ENTERTAIN['categories'];
		}
		
		public static function get_category_label($category = NULL)
		{
			global $_ENTERTAIN;
			if(isset($category))
			{
				return $_ENTERTAIN['categories'][$category]['label'];
			}
			else
			{
				return null;
				//return $_ENTERTAIN['categories'][null]['label'];
			}
		}
		
		function render_edit_form()
		{
			Tools::debug('<span style="color: red;">Don\'t use this, put a render_edit_form() function in your specific object class instead</span>');
			
			return template('entertain', 'admin/edit/text.php', array('item' => $this));
		}
		
		function render()
		{
			Tools::debug('Render called on generic entertain class!');
		}
		
		function preview_image($dimension)
		{
			$dimension = (in_array($dimension, array('full', 'medium'))) ? $dimension : 'medium';
			if($this->has_image == true)
			{
				return 'http://static.hamsterpaj.net/images/entertain/items/' . $this->handle . '/' . $dimension . '.png';
			}
			return 'http://static.hamsterpaj.net/images/entertain/default_previews/' . $this->category . '_' . $dimension . '.png';
		}
		
		public static function fetch($search)
		{
			global $_PDO;

			Tools::pick_inplace($search['allow_multiple'], false);
			
			$query = 'SELECT * FROM entertain WHERE 1';
			$query .= (isset($search['handle'])) ? ' AND handle = :handle' : null;
			$query .= (isset($search['type'])) ? ' AND type = :type' : null;
			$query .= (isset($search['ids'])) ? ' AND id IN ("' . implode('", "', $search['ids']) . '")' : null;
			$query .= (isset($search['category'])) ? ' AND category = :category' : null;
			$query .= (isset($search['status'])) ? ' AND status = :status' : null;
			$query .= (isset($search['order_by'])) ? ' ORDER BY ' . $search['order_by'] : null;
			$query .= (isset($search['limit'])) ? ' LIMIT :limit' : null;

			$stmt = $_PDO->prepare($query);
			(isset($search['handle'])) ? $stmt->bindValue(':handle', $search['handle']) : null;
			(isset($search['type'])) ? $stmt->bindValue(':type', $search['type']) : null;
			(isset($search['category'])) ? $stmt->bindValue(':category', $search['category']) : null;
			(isset($search['status'])) ? $stmt->bindValue(':status', $search['status']) : null;
			(isset($search['limit'])) ? $stmt->bindValue(':limit', $search['limit'], PDO::PARAM_INT) : null;
			$stmt->execute();
			
			$items = array();
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if(class_exists('Entertain' . $row['type']))
				{
					$class = 'Entertain' . $row['type'];
					$item = new $class();
				}
				else
				{
					Tools::debug('ERROR: Class Entertain_' . $row['type'] . ' does not exist!');
					$item = new Entertain();				
				}
				
				$item->id = $row['id'];
				$item->type = $row['type'];
				$item->category = $row['category'];
				$item->title = $row['title'];
				$item->handle = $row['handle'];
				$item->click = (isset($row['click']) ? $row['click'] : false); // Does click even exist?
				$item->data = unserialize($row['data']);
				$item->has_image = $row['has_image'];
				$item->status = $row['status'];
				$item->views = $row['views'];
				$item->released_by = $row['released_by'];
				$item->created_by = $row['created_by'];
				$item->released_at = $row['released_at'];
				$item->created_at = $row['created_at'];
				$item->updated_at = $row['updated_at'];
				$item->updated_by = $row['updated_by'];
				
				$item->tags = Tag::fetch(array('system' => 'entertain', 'item_id' => $item->id));
				
				if($search['allow_multiple'] == true)
				{
					$items[] = $item;
				}
				else
				{
					return $item;
				}
			}
			if($search['allow_multiple'])
			{
				return $items;
			}
			return false;
		}

		function __construct()
		{
			$this->updated_at = time();
			$this->created_at = time();
		}
		
		function update_from_post($user)
		{
			$this->set(array('title' => $_POST['title']));
			$this->set(array('category' => $_POST['category']));
			$this->set(array('has_image' => $_POST['has_image']));
			$this->set(array('status' => $_POST['status']));
			$this->set(array('updated_at' => time()));
			$this->set(array('updated_by' => $user->id));
			$this->set(array('released_at' => time()));
			$this->set(array('released_by' => $user->id));
			//$this->set(array('release' => strtotime($_POST['release'])));
			$this->update_data_from_post();
			
			// add tags
			Tag::save(array('mastertags' => $_POST['mastertags'], 'subtags' => $_POST['subtags'], 'system' => 'entertain', 'item_id' => $this->id));
		}
		
		function get_url()
		{
			return '/' . $this->get('category') . '/' . $this->handle;
		}
		
		function get_edit_url()
		{
			return '/entertain-admin/redigera/' . $this->handle;
		}
		
		function get_preview_url()
		{
			return '/entertain-admin/forhandsgranska/' . $this->handle;
		}	
		
		function get_remove_url()
		{
				return '/entertain-admin/radera/' . $this->handle;
		}

		function set_title($title)
		{
			$this->title = $title;
			if(strlen($this->handle) == 0)
			{
				$handle = Tools::handle($title);
				for($i = 2; $i < 50; $i++)
				{
					if(Entertain::fetch(array('handle' => $handle)))
					{
						$handle = Tools::handle($title) . '-' . $i;
					}
					else
					{
						$this->handle = $handle;
						return true;
					}
				}
			}
		}
		
		function set_released_at($time)
		{
			if($this->status == 'released')
			{
				$this->released_at = $time;
				return true;
			}
		}
		
		function set_released_by($user_id)
		{
			if($this->status == 'released')
			{
				$this->released_by = $user_id;
				
			}
			else
			{
				$this->released_by = NULL;
			}
			return true;
		}
		
		function save()
		{
			global $_PDO;
			
			if($this->id > 0)
			{
				$query = 'UPDATE entertain SET title = :title, data = :data, category = :category, has_image = :has_image, status = :status, updated_at = :updated_at, updated_by = :updated_by, released_at = :released_at, released_by = :released_by, views = :views WHERE id = :id LIMIT 1';
				
				$stmt = $_PDO->prepare($query);
				$stmt->bindValue(':title', $this->title); 
				$stmt->bindValue(':data', serialize($this->data));
				$stmt->bindValue(':category', $this->category);
				$stmt->bindValue(':has_image', $this->has_image);
				$stmt->bindValue(':id', $this->id);
				$stmt->bindValue(':status', $this->status);
				$stmt->bindValue(':updated_at', $this->updated_at);
				$stmt->bindValue(':updated_by', $this->updated_by);
				$stmt->bindValue(':released_at', $this->released_at);
				$stmt->bindValue(':released_by', $this->released_by);
				$stmt->bindValue(':views', $this->views);
				if(!$stmt->execute())
				{
					Tools::debug($stmt->errorInfo());
				}
			}
			else
			{
				$query = 'INSERT INTO entertain (type, category, title, handle, data, has_image, created_at, created_by, updated_at, updated_by, released_at, released_by, status)';
				$query .= ' VALUES(:type, :category, :title, :handle, :data, :has_image, :created_at, :created_by, :updated_at, :updated_by, :released_at, :released_by, :status)';

				$stmt = $_PDO->prepare($query);
				$stmt->bindValue(':type', $this->type); 
				$stmt->bindValue(':category', $this->category);
				$stmt->bindValue(':title', $this->title);
				$stmt->bindValue(':handle', $this->handle);
				$stmt->bindValue(':data', serialize($this->data));
				$stmt->bindValue(':has_image', $this->has_image);
				$stmt->bindValue(':created_at', $this->created_at);
				$stmt->bindValue(':created_by', $this->created_by);
				$stmt->bindValue(':updated_at', $this->updated_at);
				$stmt->bindValue(':updated_by', $this->updated_by);
				$stmt->bindValue(':released_at', $this->released_at);
				$stmt->bindValue(':released_by', $this->released_by);
				$stmt->bindValue(':status', $this->status);
				if(!$stmt->execute())
				{
					Tools::debug($stmt->errorInfo());
				}
			}
		}
		
		function remove()
		{
			$this->status = 'removed';
			$this->save();
		}
		
		function item_list($items, $view = 'default')
		{
			return template('entertain', 'item_list.php', array('items' => $items));
		}
	}
?>